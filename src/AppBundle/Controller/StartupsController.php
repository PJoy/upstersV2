<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 13/08/2016
 * Time: 16:40
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StartupsController extends Controller {

    /**
     * @Route("/statups", name="startups")
     */
    public function startupAction(){

        //DUMMY DATA
        $user = array(
            'name' => 'Jean Jean',
            'messages' => rand(0,9)
        );

        return $this->render('V2/startups.html.twig',[
            'title' => 'Annuaire des startups | Upsters',
            'user' => $user
        ]);
    }
}