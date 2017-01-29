<?php

namespace ExNihilo\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PresentationController extends Controller
{
    public function indexAction()
    {

        return $this->render('ExNihiloPlatformBundle:Front:presentation.html.twig', array(
            'presentation'=> $this->get('manage_presentation')->presentationIndex()
        ));
    }

}