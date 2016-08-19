<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 16/08/2016
 * Time: 10:19
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class AddContentController
{

    /**
     * @Route("/add/{type}", name="addContent")
     */

    public function addContentAction($type){
        return new Response('Page to add new '.$type);
    }
}