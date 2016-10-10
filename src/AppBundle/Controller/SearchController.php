<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 10/10/2016
 * Time: 16:10
 */

namespace AppBundle\Controller;


class SearchController
{
    function searchAction($searchTerm){
        $resources = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Resource')
            ->findAll();

        $media = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Media')
            ->findAll();

        $startups = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Startup')
            ->findAll();
    }

}