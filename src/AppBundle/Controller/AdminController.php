<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 25/08/2016
 * Time: 15:36
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Media;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/", name="admin")
     */
    public function helloAction(){
        return new Response('hello');
    }

    /**
     * @Route("/register")
     */
    public function registerOldData()
    {
        $finder = new Finder();
        $finder->files()
            ->in(__DIR__ . '/../from_migration')
            ->name('media.csv')
        ;
        foreach ($finder as $file) { $csv = $file; }

        $em = $this->getDoctrine()->getManager();

            if (($handle = fopen($csv->getRealPath(), "r")) !== FALSE) {
                $data = fgetcsv($handle, null, ";");
                //first line

                while (($data = fgetcsv($handle, null, ";")) !== FALSE) {
                $user = $this->getUser();

                $media = new Media();
                $media->setName($data[0]);
                $media->setCategory($data[1]);
                $media->setTags(explode('[]',$data[2]));
                $media->setLink($data[3]);
                $media->setSubmittedBy($user);
                /*dump($data[4]);
                dump((int)$data[4]);
                die;*/
                $media->setDateSubmitted(new \DateTime("@".(int)$data[4]));

                $media->setComment('yo');

                $em->persist($media);
                $em->flush();

            }
            fclose($handle);
        }


        /*$media = new Media();
        $media->setCategory()*/

        //dump($rows);die;

        return new Response('OK');
    }
}