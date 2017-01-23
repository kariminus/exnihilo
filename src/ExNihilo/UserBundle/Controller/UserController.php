<?php

namespace ExNihilo\UserBundle\Controller;

use ExNihilo\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 */
class UserController extends Controller
{

    public function indexAction()
    {

        $manageUser = $this->get('manage_user');
        $users = $manageUser->userIndex();

        return $this->render('ExNihiloUserBundle:user:index.html.twig', array(
            'users' => $users,
        ));

    }


    public function showAction(User $user)
    {
        $manageUser = $this->get('manage_user');
        $array = $manageUser->userShow($user);

        return $this->render('ExNihiloUserBundle:user:show.html.twig', array(
            'user' => $array[0],
            'delete_form' => $array[1]->createView(),
        ));
    }


    public function editAction(Request $request, User $user)
    {

        $manageUser = $this->get('manage_user');
        $array = $manageUser->userEdit($request, $user);

        return $this->render('ExNihiloUserBundle:user:edit.html.twig', array(
            'user' => $array[0],
            'edit_form' => $array[1]->createView(),
            'delete_form' => $array[2]->createView(),
        ));
    }


    public function deleteAction(Request $request, User $user)
    {
        $manageUser = $this->get('manage_user');
        $manageUser->userDelete($request, $user);

        return $this->redirectToRoute('admin_user_index');
    }

}
