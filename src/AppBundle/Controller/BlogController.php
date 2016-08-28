<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 19/08/2016
 * Time: 17:02
 */

namespace AppBundle\Controller;


use AppBundle\Service\BlogManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/commands")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class BlogController extends Controller
{

    /**
     * @Route("/publish/{id}", name="publishArticle")
     */
    public function publishArticleAction($id){
        $bm = new BlogManager($this->getDoctrine()->getManager(), null);
        $bm->publishArticle($id);

        return new  Response('Article '.$id.' published !');
    }

    /**
     * @Route("/unpublish/{id}", name="unpublishArticle")
     */
    public function unpublishArticleAction($id){
        $bm = new BlogManager($this->getDoctrine()->getManager(), null);
        $bm->unpublishArticle($id);

        return new  Response('Article '.$id.' unpublished :(');
    }
}