<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 13/08/2016
 * Time: 16:40
 */

namespace AppBundle\Controller;


use AppBundle\Form\StartupFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/startups")
 */
class StartupsController extends Controller {

    /**
     * @Route("/", name="startups_home")
     */
    public function startupAction(){
        $startups = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:Startup')
            ->findAll();

        $search = '';
        if(isset($_GET['search'])) {
            $search = $_GET['search'];
        }

        $mapData = [];

        foreach ($startups as $startup){

            $lat = floatval($startup->getGPSLat());
            $long = floatval($startup->getGPSLong());

            if ($lat != 0 && $long != 0){
                array_push($mapData,[
                    'type' => 'startup',
                    'name' => $startup->getName(),
                    'lat' => $lat,
                    'long' => $long
                ]);
            }
        }


        return $this->render('startups/index.html.twig',[
            'title' => 'Annuaire des startups | Upsters',
            'startups' => $startups,
            'search' => $search,
            'mapData' => $mapData
        ]);
    }

    /**
     * @Route("/add", name="startup_add")
     */
    public function startupAddAction(Request $request) {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $user = $this->getUser();

        $form = $this->createForm(StartupFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $startup = $form->getData();


            //TODO : set user before the form is actually submitted
            $startup->setSubmittedBy($user);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($startup);
            $em->flush();

            $this->addFlash('success', 'Startup ajoutée !');

            return $this->redirectToRoute('startups_home');
        }

        return $this->render('startups/add.html.twig', [
            'startupFrom' => $form->createView()
        ]);
    }

    /**
     * @Route("/{name}", name="startup_display")
     */
    public function startupDisplayAction($name){
        $em = $this->getDoctrine()->getManager();
        $startup = $em->getRepository('AppBundle:Startup')
            ->findOneBy( ['name' => $name ]);

        $startup->setViews($startup->getViews()+1);
        $em->flush();

        //TODO name shouldn't be 'add'
        return $this->render('startup/display.html.twig', [
            'startup' => $startup
        ]);
    }

}
