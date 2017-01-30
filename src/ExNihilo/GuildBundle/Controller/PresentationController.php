<?php

namespace ExNihilo\GuildBundle\Controller;

use ExNihilo\GuildBundle\Entity\Presentation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Presentation controller.
 *
 */
class PresentationController extends Controller
{

    public function indexAction()
    {
        return $this->render('ExNihiloGuildBundle:presentation:index.html.twig', array(
            'presentation' => $this->get('manage_presentation')->PresentationIndex(),
        ));
    }


    public function newAction(Request $request)
    {
        $array = $this->get('manage_presentation')->PresentationNew($request);

        return $this->render('ExNihiloGuildBundle:presentation:new.html.twig', array(
            'presentation' => $array[0],
            'form' => $array[1]->createView(),
        ));
    }


    public function editAction(Request $request, Presentation $presentation)
    {
        $array = $this->get('manage_presentation')->presentationEdit($request, $presentation);

        return $this->render('ExNihiloGuildBundle:presentation:edit.html.twig', array(
            'presentation' => $array[0],
            'edit_form' => $array[1]->createView(),
        ));
    }


}
