<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 10/10/2016
 * Time: 16:10
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SearchController extends Controller
{
    /**
     * @Route("/search/", name="search_results")
     */
    function searchAction(){
        $args = $_GET;

        $resources = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Resource')
            ->findAll();

        $media = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Media')
            ->findAll();

        $startups = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Startup')
            ->findAll();

        $sMedia = serialize($media[0]);
        echo strcmp($args,$sMedia);


        dump(serialize($media[0]));die;

        return $this->render('search/index.html.twig',[
            'resources' => $resources,
            'medias' => $media,
            'startups' => $startups
        ]);
    }

}