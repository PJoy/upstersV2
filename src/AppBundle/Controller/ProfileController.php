<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 13/08/2016
 * Time: 16:40
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Like;
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

        $resourceCount = rand(0,10);
        $recomCount = rand(0,10);
        $startupCount = rand(0,10);
        $likeCount = rand(0,10);
        $forumCount = rand(0,10);

        $recoms = $em->getRepository(Like::class)->findAll([
            'user_id' => $user->getId()
        ]);

        $totalRecomViews = 0;
        foreach ($recoms as $recom){
            $object = $em->getRepository('AppBundle:'.$recom->getContentType())->findOneBy([
                'id' => $recom->getContentId()
            ]);
            $totalRecomViews += $object->getViews();
            //dump($object);exit;
        }

        $startupViews = 0;

        if (count($user)!=0){
            $user->setViews($user->getViews()+1);
            $em->flush();

            return $this->render('V2/profile.html.twig',[
                'title' => 'Profil de '.$name.' | Upsters',
                'user' => $user,
                'recomCount' => $recomCount,
                'startupCount' => $startupCount,
                'resourceCount' => $resourceCount,
                'followCount' => $likeCount,
                'forumCount' => $forumCount,
                'recomViews' => $totalRecomViews,
                'startupViews' => $startupViews
            ]);
        } else {
            return $this->render('profile/empty.thml.twig', [
                'title' => 'L\'utilisateur n\'existe pas ! | Upsters'
            ]);
        }
    }
}