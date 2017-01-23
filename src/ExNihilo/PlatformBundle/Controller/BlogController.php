<?php

namespace ExNihilo\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function indexAction()
    {
        return $this->render('ExNihiloPlatformBundle:Front:index.html.twig');
    }
}
