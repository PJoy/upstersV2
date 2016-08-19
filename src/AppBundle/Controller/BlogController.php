<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 19/08/2016
 * Time: 17:02
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    /**
     * @Route("/blog", name="blogIndex")
     */
    public function blogIndexAction(){
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('AppBundle\Entity\Article')
            ->findAll();

        //DUMMY DATA
        $user = array(
            'name' => 'Julie',
            'messages' => rand(0,9)
        );

        return $this->render('V2/blogIndex.html.twig',[
            'title' => 'Blog | Upsters',
            'user' => $user,
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/blog/{articleName}", name="blog")
     */
    public function showArticleAction($articleName){

        //FETCH ARTICLE
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle\Entity\Article')
            ->findOneBy(array('name' => $articleName));

        $articleContent = $article->getContent();

        $formatedContent = $this->container->get('markdown.parser')
            ->transform($articleContent);

        //DUMMY DATA
        $user = array(
            'name' => 'Julie',
            'messages' => rand(0,9)
        );

        return $this->render('V2/blogArticle.html.twig',[
            'title' => 'Entreprenons ensemble | Upsters',
            'user' => $user,
            'post' => $article,
            'content' => $formatedContent
        ]);
    }
}