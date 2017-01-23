<?php

namespace ExNihilo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ExNihiloUserBundle:Default:index.html.twig');
    }
}
