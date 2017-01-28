<?php

namespace ExNihilo\UserBundle\Controller;

use ExNihilo\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ExNihilo\UserBundle\Form\UserRegistrationForm;

/**
 * User controller.
 *
 */
class UserController extends Controller
{

    public function registerAction(Request $request)
    {

        $form = $this->createForm(UserRegistrationForm::class);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Bienvenue '.$user->getUsername());

            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $this->get('app.security.login_form_authenticator'),
                    'main'
                );


        }

        return $this->render('ExNihiloUserBundle:user:register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function indexAction()
    {

        $manageUser = $this->get('manage_user');
        $users = $manageUser->userIndex();

        return $this->render('ExNihiloUserBundle:user:index.html.twig', array(
            'users' => $users,
        ));

    }


    public function editAction(Request $request, User $user)
    {

        $manageUser = $this->get('manage_user');
        $array = $manageUser->userEdit($request, $user);

        return $this->render('ExNihiloUserBundle:user:edit.html.twig', array(
            'user' => $array[0],
            'form' => $array[1]->createView(),
        ));
    }


    public function deleteAction($id)
    {
        $manageUser = $this->get('manage_user');
        $manageUser->userDelete($id);

        return $this->redirectToRoute('admin_user_index');
    }



}
