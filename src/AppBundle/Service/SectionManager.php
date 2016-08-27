<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 27/08/2016
 * Time: 11:18
 */

namespace AppBundle\Service;


class SectionManager
{

    public function __construct($sectionType, $entityManager=null, $templatingManager=null, $formFactory=null)
    {
        $this->section = $sectionType;
        $this->em = $entityManager;
        $this->tm = $templatingManager;
        $this->ff = $formFactory;
    }

    /**
     * Generate section home
     */
    public function generateHomeRender(){
        ${$this->section.'s'} = $this->em
            ->getRepository('AppBundle:'.ucfirst($this->section))
            ->findAll();

        //DUMMY DATA
        $user = array(
            'name' => 'José',
            'messages' => rand(0,9)
        );

        $yo = $this->tm->render('V2/media.html.twig', [
            'title' => 'Annuaire des '.$this->section.'s | Upsters',
            'user' => $user,
            $this->section.'s' => ${$this->section.'s'}
        ]);

        return $yo;

    }

    public function generateAddRender(){
        //todo change media
        $form = $this->ff->createForm(MediaFormType::class);

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