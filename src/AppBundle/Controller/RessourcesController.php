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

class RessourcesController extends Controller {

    /**
     * @Route("/ressources", name="ressources")
     */
    public function ressourcesAction(){

        //DUMMY DATA
        $user = array(
            'name' => 'Pierre Emanuel',
            'messages' => rand(0,9)
        );

        return $this->render('V2/ressources.html.twig',[
            'title' => 'Annuaire des ressources | Upsters',
            'user' => $user
        ]);
    }
}