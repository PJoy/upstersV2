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
use AppBundle\Form\UserEditForm;
use AppBundle\Service\BlogManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/admin")
 * @Security("is_granted('ROLE_ADMIN')")
 */
class AdminController extends Controller
{

    /* HOME ADMIN */
    /**
     * @Route("/", name="admin")
     */
    public function indexAction(){
        return $this->render('admin/index.html.twig');
    }

    /* AJAX */

    /**
     * @Route("/AJAX/publish-unpublish/{id}", name="pubUnpub")
     */
    public function pubUnpub($id)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Article')->findOneBy(array(
            'id' => $id
        ));

        $bm = new BlogManager($this->getDoctrine()->getManager(), null);
        if ($article->getPublished()){
            $bm->unpublishArticle($id);

            return new  Response('Article '.$id.' unpublished :(');
        } else {
            $bm->publishArticle($id);

            return new  Response('Article '.$id.' published !');
        }
    }

    /* MEDIA ADMIN */
    /**
     * @Route("/media", name="admin_media")
     */
    public function mediaIndexAction(){
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository('AppBundle:Media')->findAll();

        return $this->render('admin/mediaIndex.html.twig', [
            'media' => $media
        ]);
    }

    /**
     * @Route("/media/register-old", name="register_old_media")
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

    /* RESOURCES ADMIN */
    /**
     * @Route("/resources", name="admin_resource")
     */
    public function resourcesIndexAction(){
        $em = $this->getDoctrine()->getManager();
        $resources = $em->getRepository('AppBundle:Resource')->findAll();

        return $this->render('admin/resourceIndex.html.twig', [
            'resources' => $resources
        ]);
    }

    /**
     * @Route("/resources/register-old", name="register_old_resources")
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


    /* STARTUPS ADMIN */
    /**
     * @Route("/startups", name="admin_startups")
     */
    public function startupsIndexAction(){
        return $this->render('admin/startupsIndex.html.twig');
    }

    /* BLOG ADMIN */
    /**
     * @Route("/blog", name="admin_blog")
     */
    public function blogIndexAction(){
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository('AppBundle:Article')->findAll();
        $articlesRegistered = (count($articles)!=0);

        return $this->render('admin/blogIndex.html.twig', [
            'registered' => $articlesRegistered,
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/blog/register", name="register_articles")
     */
    public function registerArticleAction(){

        $bm = new BlogManager($this->getDoctrine()->getManager(), null);
        $bm->registerArticles();

        return new  Response('Articles registered in database!');
    }

    /* USERS ADMIN */
    /**
     * @Route("/users", name="admin_users")
     */
    public function usersIndexAction(){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();

        return $this->render('admin/usersIndex.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/users/edit/{name}", name="admin_user_edit")
     */
    public function userEditAction($name, Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->findOneBy(array(
            'name' => $name
        ));
        if ($user === null){
            return $this->render('admin/emptyUser.html.twig');
        }

        $form = $this->createForm(UserEditForm::class, $user);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $file = $user->getImage();
            if ($file !== null){
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('avatars_dir'),
                    $fileName
                );
                $user->setImage($fileName);
            }

            //$user->setRoles(array());
            $em->flush();

            $this->addFlash('success', 'Prestataire modifié !');

            return $this->redirectToRoute('admin_users');
        }

        return $this->render('admin/userEdit.html.twig', [
            'userEditForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/AJAX/read", name="ajax_read")
     */
    public function ajaxReadAction(Request $request){
        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager();
        $notif = $em->getRepository('AppBundle:Notification')->findOneBy([
            'id' => $id
        ]);

        $notif->setWasRead(true);
        $em->flush();

        $unread = $em->getRepository('AppBundle:Notification')->findAll([
            'destId' => $notif->getDestId(),
            'unread' => true
        ]);

        $user = $em->getRepository('AppBundle:User')->findOneBy([
            'id' => $notif->getDestId()
        ]);

        $user->setUnreadNotifications(count($unread));


        return new Response('yo');
    }

}