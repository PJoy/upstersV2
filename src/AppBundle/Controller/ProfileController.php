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

class ProfileController extends Controller {

    /**
     * @Route("/user/{name}", name="user")
     */
    public function profileAction($name){

        //DUMMY DATA
        $user = array(
            'name' => $name,
            'messages' => rand(0,9)
        );

        return $this->render('V2/profile.html.twig',[
            'title' => 'Profil de '.$name.' | Upsters',
        ]);
    }
}