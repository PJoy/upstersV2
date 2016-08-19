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

class MediaController extends Controller {

    /**
     * @Route("/media", name="media")
     */
    public function mediaAction(){

        //DUMMY DATA
        $user = array(
            'name' => 'José',
            'messages' => rand(0,9)
        );

        return $this->render('V2/media.html.twig',[
            'title' => 'Annuaire des médias | Upsters',
            'user' => $user
        ]);
    }
}