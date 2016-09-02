<?php
/**
 * Created by PhpStorm.
 * User: pierreportejoie
 * Date: 25/08/2016
 * Time: 13:06
 */

namespace AppBundle\Controller;


use AppBundle\Form\UserRegistrationForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     */
    public function registerAction(Request $request){

        $form = $this->createForm(UserRegistrationForm::class);

        $form->handleRequest($request);
        if($form->isValid()) {
            $user = $form->getData();
            if ($user->getName() === null) {
                $user->setName(explode('@',$user->getEmail())[0]);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            //TODO : wtf is this ?
            $this->addFlash('success', 'Welcome '.$user->getEmail());

            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $this->get('app.security.login_form_authenticator'),
                    'main'
                );
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}