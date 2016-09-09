<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 09/09/2016
 * Time: 14:31
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Like;
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
        $like = $em->getRepository('AppBundle:Like')->findBy(array(
            'contentType' => $contentType,
            'userId' => $userId,
            'contentId' => $contentId
        ));

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
            $content = $em->getRepository('AppBundle:'.$contentType)->findOneBy(array(
                'id' => $contentId
            ));
            $content->setLikesCount($content->getLikesCount()+1);
            $em->flush();
        }

        return new Response('ok');
    }
}