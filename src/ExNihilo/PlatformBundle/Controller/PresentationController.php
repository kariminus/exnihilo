<?php

namespace ExNihilo\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PresentationController extends Controller
{
    public function indexAction()
    {
        $array = $this->get('manage_presentation')->presentationView();

        return $this->render('ExNihiloPlatformBundle:Front:presentation.html.twig', array(
            'presentation' => $array[0],
            'images' => $array[1],
        ));
    }

}