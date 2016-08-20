<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 20/08/2016
 * Time: 16:04
 */

namespace AppBundle\Service;

use Symfony\Component\Finder\Finder;
use AppBundle\Entity\Article;

class BlogManager
{
    private $entityManager;

    public function __construct($entityManager,$parser)
    {
        $this->em = $entityManager;
        $this->parser = $parser;
    }

    /**
     * FORMATTING FUNCTIONS
     */

    private function formatContent($article){
        $article->setContent(
            $this->parser->transform($article->getContent())
        );
    }

    /**
     * DATABASE QUERIES
     */

    public function registerArticles()
    {
        $finder = new Finder();
        $finder->in(__DIR__ . '/../articles');

        foreach ($finder as $file) {
            /*
             * Parse filename
             */
            $pathName = $file->getRelativePathname();
            $args = explode('-', $pathName);

            $id = $args[0];
            $name = $args[1];
            $keywords = explode('.', $args[2]);
            switch (explode('.', $args[3])[0]) {
                case (800):
                    $type = 'long';
                    break;
                case (400):
                    $type = 'short';
                    break;
                default:
                    $type = 'other';
                    break;
            }
            $content = $file->getContents();
            $published = false;

            /*
             * register article in database
             */
            $article = new Article();
            $article->setId($id);
            $article->setName($name);
            $article->setKeywords($keywords);
            $article->setType($type);
            $article->setContent($content);
            $article->setPublished($published);

            $this->em->persist($article);
            $this->em->flush();
        }
    }

    public function publishArticle($id){
        $this->em->getRepository('AppBundle:Article')->setPublishedTrue($id);
    }

     public function unpublishArticle($id){
        $this->em->getRepository('AppBundle:Article')->setPublishedFalse($id);
    }

    public function getAllPublishedArticles(){
        $articles = $this->em->getRepository('AppBundle:Article')->findBy(array('published' => true));
        foreach ($articles as $article) $this->formatContent($article);
        return $articles;
    }

    public function getArticleIfPublished($name){
        $article = $this->em->getRepository('AppBundle:Article')->findOneBy(array('published' => true, 'name' => $name));
        if ($article !== null) $this->formatContent($article);
        return $article;
    }

}