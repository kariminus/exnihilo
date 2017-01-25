<?php

namespace ExNihilo\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MembersController extends Controller
{
    public function indexAction()
    {
        $manageUsers = $this->get('manage_user');
        $users = $manageUsers->userIndex();

        return $this->render('ExNihiloPlatformBundle:Front:members.html.twig', array(
            'users'=> $users
        ));
    }

}