<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 13/08/2016
 * Time: 16:40
 */

namespace AppBundle\Controller;


use AppBundle\Form\MediaFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @Route("/media")
 */
class MediaController extends Controller {

    /**
     * @Route("/", name="media_home")
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

    /**
     * @Route("/add", name="media_add")
     */
    public function mediaAddAction(Request $request)
    {
        $form = $this->createForm(MediaFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $media = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($media);
            $em->flush();

            $this->addFlash('success', 'Média ajouté !');

            return $this->redirectToRoute('media_home');

        }

        return $this->render('media/add.html.twig', [
            'mediaForm' => $form->createView()
        ]);
    }

}