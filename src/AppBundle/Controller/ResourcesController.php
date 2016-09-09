<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 13/08/2016
 * Time: 16:40
 */

namespace AppBundle\Controller;


use AppBundle\Form\ResourceFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/resources")
 */
class ResourcesController extends Controller {

    /**
     * @Route("/", name="resources_home")
     */
    public function resourcesAction(){

        $resources = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Resource')
            ->findAll();

        $search = '';
        if(isset($_GET['search'])) {
            $search = $_GET['search'];
        }

            return $this->render('V2/resources.html.twig',[
            'title' => 'Annuaire des prestataires | Upsters',
            'resources' => $resources,
            'search' => $search
        ]);

    }

    /**
     * @Route("/add", name="resource_add")
     */
    public function resourceAddAction(Request $request)
    {
        $form = $this->createForm(ResourceFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $resource = $form->getData();

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($resource);
            $em->flush();

            $this->addFlash('success', 'Prestataire ajouté !');

            return $this->redirectToRoute('resources_home');

        }

        return $this->render('resource/add.html.twig', [
            'resourceForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{name}", name="resource_display")
     * TODO : url friendly names
     */
    public function resourceDisplayAction($name)
    {
        $em = $this->getDoctrine()->getManager();
        $resource = $em->getRepository('AppBundle:Resource')
            ->findOneBy( ['name' => $name ]);

        //TODO name shouldn't be 'add'
        return $this->render('resource/display.html.twig', [
            'resource' => $resource
        ]);
    }


}