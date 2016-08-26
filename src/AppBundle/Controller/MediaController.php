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

        $medias = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Media')
            ->findAll();

        //DUMMY DATA
        $user = array(
            'name' => 'José',
            'messages' => rand(0,9)
        );

        return $this->render('V2/media.html.twig',[
            'title' => 'Annuaire des médias | Upsters',
            'user' => $user,
            'medias' => $medias
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

    /**
     * @Route("/{name}", name="media_display")
     * TODO : url friendly names
     */
    public function mediaDisplayAction($name)
    {
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('AppBundle:Media')
            ->findOneBy( ['name' => $name ]);

        //TODO name shouldn't be 'add'
        return $this->render('media/display.html.twig', [
            'media' => $media
        ]);
    }

}