<?php

namespace ExNihilo\EventBundle\Controller;

use ExNihilo\EventBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{

    public function indexAction()
    {
        $manageEvent = $this->get('manage_event');
        $events = $manageEvent->eventIndex();

        return $this->render('ExNihiloEventBundle:event:index.html.twig', array(
            'events' => $events,
        ));
    }


    public function newAction(Request $request)
    {
        $manageEvent = $this->get('manage_event');
        $array = $manageEvent->eventNew($request);

        return $this->render('ExNihiloEventBundle:event:new.html.twig', array(
            'event' => $array[0],
            'form' => $array[1]->createView(),
        ));
    }


    public function showAction(Event $event)
    {
        $manageEvent = $this->get('manage_event');
        $array = $manageEvent->EventShow($event);

        return $this->render('ExNihiloEventBundle:event:show.html.twig', array(
            'event' => $array[0],
            'delete_form' => $array[1]->createView(),
        ));
    }

    public function viewAction($id)
    {
        $manageEvent = $this->get('manage_event');
        $event = $manageEvent->EventView($id);

        return $this->render('ExNihiloEventBundle:event:view.html.twig', array(
            'event' => $event,
        ));
    }


    public function editAction(Request $request, Event $event)
    {

        $manageEvent = $this->get('manage_event');
        $array = $manageEvent->eventEdit($request, $event);

        return $this->render('ExNihiloEventBundle:event:edit.html.twig', array(
            'event' => $array[0],
            'edit_form' => $array[1]->createView(),
            'delete_form' => $array[2]->createView(),
        ));
    }

    public function deleteAction(Request $request, Event $event)
    {
        $manageEvent = $this->get('manage_event');
        $manageEvent->eventDelete($request, $event);

        return $this->redirectToRoute('admin_event_index');
    }

}
