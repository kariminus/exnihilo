<?php

namespace ExNihilo\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MembersController extends Controller
{
    public function indexAction()
    {
        $manageUsers = $this->get('manage_user');
        $manageClasses = $this->get('manage_classe');
        $classes = $manageClasses->classeIndex();


        return $this->render('ExNihiloPlatformBundle:Front:users.html.twig', array(
            'classes' => $classes,
        ));
    }

    public function getUsersAction($id)
    {
        return $this->render(
            'ExNihiloPlatformBundle:Front:members.html.twig',
            array('users' => $this->get('manage_user')->getUsers($id))
        );

    }
}