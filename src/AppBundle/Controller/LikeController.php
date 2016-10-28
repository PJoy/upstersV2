<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 09/09/2016
 * Time: 14:31
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Like;
use AppBundle\Entity\Notification;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class LikeController extends Controller
{
    /**
     * @Route("/AJAX/like", name="ajax_like")
     */
    public function likeAction(Request $request){
        $contentType = $request->get('type');
        $userId = $request->get('userId');
        $contentId = $request->get('id');
        $date = new \DateTime();

        $em = $this->getDoctrine()->getManager();
        $like = $em->getRepository('AppBundle:Like')->findOneBy(array(
            'contentType' => $contentType,
            'userId' => $userId,
            'contentId' => $contentId
        ));

        $content = $em->getRepository('AppBundle:'.$contentType)->findOneBy(array(
            'id' => $contentId
        ));

        $user = $em->getRepository('AppBundle:User')->findOneBy([
            'id' => $userId
        ]);

        $notifiedUser = $em->getRepository('AppBundle:User')->findOneBy([
            'id' => $content->getSubmittedBy()
        ]);

        if ($like === null) {
            //Save like
            $like = new Like();
            $like->setContentType($contentType);
            $like->setUserId($userId);
            $like->setContentId($contentId);
            $like->setDate($date);

            $em->persist($like);
            $em->flush();

            //increase content like count
            $content->setLikesCount($content->getLikesCount()+1);

            //increase user like count
            $user->setLikedCount($user->getLikedCount()+1);

            $response = 'Nouvelle recommandation';

            $notification = new Notification('Recommandation',$contentType,$contentId,$notifiedUser->getId());
            $notification->setMessage($response);
            $em->persist($notification);

        } else {
            //remove like
            $em->remove($like);

            //decrease content like count
            $content->setLikesCount($content->getLikesCount()-1);

            //decrease user like count
            $user->setLikedCount($user->getLikedCount()-1);

            $response = 'like removed';
        }

        $em->flush();

        $unread = $em->getRepository('AppBundle:Notification')->findBy([
            'destId' => $notifiedUser->getId(),
            'wasRead' => false
        ]);

        $notifiedUser->setUnreadNotifications(count($unread));
        $em->flush();


        return new Response('ok');
    }
}