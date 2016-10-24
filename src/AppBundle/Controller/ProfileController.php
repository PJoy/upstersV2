<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 13/08/2016
 * Time: 16:40
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Like;
use AppBundle\Entity\Media;
use AppBundle\Entity\User;
use AppBundle\Form\UserEditForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ProfileController extends Controller {

    /**
     * @Route("/user/{name}", name="user")
     */
    public function profileAction($name){

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneBy(['name' => $name]);

        $media = $em->getRepository(Media::class)->findBy([
            'submittedBy' => $user->getId()
        ]);

        $resourceCount = count($media);
        $recomCount = 0;
        $startupCount = 0;
        $likeCount = 0;
        $forumCount = 0;

        $recoms = $em->getRepository(Like::class)->findBy([
            'userId' => $user->getId()
        ]);

        $totalRecomViews = 0;
        $recomObjects = [];

        foreach ($recoms as $recom){
            $object = $em->getRepository('AppBundle:'.$recom->getContentType())->findOneBy([
                'id' => $recom->getContentId()
            ]);
            $object->type = $recom->getContentType();
            $totalRecomViews += $object->getViews();
            array_push($recomObjects,$object);
            $recomCount++;
        }


        $startupViews = 0;

        $projects = [];

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
                'startupViews' => $startupViews,
                'recoms' => $recomObjects,
                'projects' => $projects
            ]);
        } else {
            return $this->render('profile/empty.thml.twig', [
                'title' => 'L\'utilisateur n\'existe pas ! | Upsters'
            ]);
        }
    }

    /**
     * @Route("/user/{name}/notifications", name="user_notifications")
     */
    function displayNotificationsAction($name){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(array(
            'name' => $name
        ));

        $notifications = $em->getRepository('AppBundle:Notification')->findBy(array(
            'destId' => $user->getId()
        ));

        $objects = [];

        foreach ($notifications as $notification){
            $object = $em->getRepository('AppBundle:'.$notification->getNotifObject())->findOneBy([
                'id' => $notification->getNotifObjectId()
            ]);
            array_push($objects, $object);
        }

        //dump($notifications);die;

        return $this->render('profile/notifications.html.twig', [
            'notifications' => $notifications,
            'objects' => $objects
        ]);
    }

    /**
     * @Route("/user/{name}/edit", name="user_edit")
     */
    function editProfileAction($name, Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(array(
            'name' => $name
        ));
        if ($user === null){
            return $this->render('admin/emptyUser.html.twig');
        }

        $userImage = $user->getImage();


        $form = $this->createForm(UserEditForm::class, $user);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $file = $user->getImage();
            if ($file !== null){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('avatars_dir'),
                    $fileName
                );
                $user->setImage($fileName);
            } else {
            $user->setImage($userImage);
            }


        //$user->setRoles(array());
            $em->flush();

            $this->addFlash('success', 'Prestataire modifié !');

            return $this->redirectToRoute('user', ['name' => $user->getName()]);
        }

        return $this->render('profile/edit.thml.twig', [
            'userEditForm' => $form->createView(),
            'profilePic' => $user->getImage()
        ]);
    }
}