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
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search_results")
     */
    function searchAction(){
        if ( $_GET['args'] == null )
            return $this->render('search/empty.html.twig');

        $args = explode(',', $_GET['args']);

        $resources = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Resource')
            ->findAll();

        $mediaz = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Media')
            ->findAll();

        $startups = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Startup')
            ->findAll();

        $selectedResources = [];
        $selectedMedia = [];
        $selectedStartups = [];

        foreach ($args as $arg){
            foreach ($resources as $resource){
                if (strpos(serialize($resource), $arg) > 0) array_push($selectedResources,$resource); }
            foreach ($mediaz as $media){ if (strpos(serialize($media), $arg) > 0) array_push($selectedMedia,$media); }
            foreach ($startups as $startup){ if (strpos(serialize($startup), $arg) > 0) array_push($selectedStartups,$startup); }
        }

        if (empty($selectedResources) && empty($selectedMedia) && empty($selectedStartups))
            return $this->render('search/empty.html.twig');

        return $this->render('search/index.html.twig',[
            'resources' => $selectedResources,
            'medias' => $selectedMedia,
            'startups' => $selectedStartups
        ]);
    }

}