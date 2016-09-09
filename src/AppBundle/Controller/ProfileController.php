<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 13/08/2016
 * Time: 16:40
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfileController extends Controller {

    /**
     * @Route("/user/{name}", name="user")
     */
    public function profileAction($name){

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(['name' => $name]);

        if (count($user)!=0){
            return $this->render('V2/profile.html.twig',[
                'title' => 'Profil de '.$name.' | Upsters',
                'user' => $user
            ]);
        } else {
            return $this->render('profile/empty.thml.twig', [
                'title' => 'L\'utilisateur n\'existe pas ! | Upsters'
            ]);
        }
    }
}