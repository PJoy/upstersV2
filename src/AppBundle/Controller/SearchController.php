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

        $mapData = [];
        

        foreach ($args as $arg){
            foreach ($resources as $resource){
                if (strpos(serialize($resource), $arg) > 0) {
                    array_push($selectedResources,$resource);
                    $lat = floatval($resource->getGPSLat());
                    $long = floatval($resource->getGPSLong());

                    if ($lat != 0 && $long != 0){

                        array_push($mapData, [
                            'type' => 'resource',
                            'name' => $resource->getName(),
                            'category' => $resource->getCategory(),
                            'lat' => $lat,
                            'long' => $long
                        ]);
                    }

                }
            }
            foreach ($mediaz as $media){
                if (strpos(serialize($media), $arg) > 0) {
                    array_push($selectedMedia,$media);
                }
            }
            foreach ($startups as $startup){
                if (strpos(serialize($startup), $arg) > 0) {
                    array_push($selectedStartups,$startup);
                    $lat = floatval($startup->getGPSLat());
                    $long = floatval($startup->getGPSLong());

                    if ($lat != 0 && $long != 0){
                        array_push($mapData,[
                            'type' => 'startup',
                            'name' => $startup->getName(),
                            'lat' => $lat,
                            'long' => $long
                        ]);
                    }

                }
            }
        }

        if (empty($selectedResources) && empty($selectedMedia) && empty($selectedStartups))
            return $this->render('search/empty.html.twig');

        return $this->render('search/index.html.twig',[
            'resources' => $selectedResources,
            'medias' => $selectedMedia,
            'startups' => $selectedStartups,
            'mapData' => $mapData
        ]);
    }

}