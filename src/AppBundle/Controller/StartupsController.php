<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 13/08/2016
 * Time: 16:40
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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

        return $this->render('startups/index.html.twig',[
            'title' => 'Annuaire des startups | Upsters',
            'startups' => $startups,
            'search' => $search
        ]);
    }

    /**
     * @Route("/{name}", name="startup_display")
     */
    public function startupDisplayAction(){
        return new Response('soon...');
    }

    /**
     * @Route("/add", name="startup_add")
     */
    public function mediaAddAction(Request $request) {
        return new Response('soon...');

    }
}
