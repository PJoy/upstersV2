<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 25/08/2016
 * Time: 15:36
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Media;
use AppBundle\Entity\Resource;
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
     * @Route("/register/media")
     */
    public function registerOldDataMedia()
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

        return new Response('OK');
    }

    /**
     * @Route("/register/resources")
     */
    public function registerOldDataServices()
    {
        $finder = new Finder();
        $finder->files()
            ->in(__DIR__ . '/../from_migration')
            ->name('services.csv')
        ;
        foreach ($finder as $file) { $csv = $file; }

        $em = $this->getDoctrine()->getManager();

            if (($handle = fopen($csv->getRealPath(), "r")) !== FALSE) {
                $data = fgetcsv($handle, null, ";");
                //first line

                while (($data = fgetcsv($handle, null, ";")) !== FALSE) {
                    $user = $this->getUser();

                    $resource = new Resource();

                    $resource->setName($data[17]);
                    $resource->setCategory($data[4]);
                    $resource->setCompany($data[0]);
                    $resource->setTags(explode('[]',$data[1]));
                    $resource->setAddress($data[5].$data[6].$data[7].$data[8]);
                    $resource->setGPSLat($data[9]);
                    $resource->setGPSLong($data[10]);
                    $resource->setOpeningTime($data[11]);
                    $resource->setWebsite($data[14]);
                    $resource->setPhone($data[12]);
                    $resource->setEmail($data[13]);
                    $resource->setTwitter($data[15]);
                    $resource->setFacebook($data[16]);
                    $resource->setLinkedin($data[19]);
                    $resource->setDescription($data[18]);

                    $em->persist($resource);
                    $em->flush();

            }
            fclose($handle);
        }

        return new Response('OK');
    }


}