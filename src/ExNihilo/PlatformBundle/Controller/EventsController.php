<?php


namespace ExNihilo\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class EventsController extends Controller
{
    public function indexAction()
    {
        $manageEvents = $this->get('manage_event');
        $events = $manageEvents->eventIndex();

        return $this->render('ExNihiloPlatformBundle:Front:events.html.twig', array(
            'events'=> $events
        ));
    }

    public function viewAction($id) {

        $manageEvent = $this->get('manage_event');
        $event = $manageEvent->EventView($id);

        return $this->render('ExNihiloEventBundle:event:view.html.twig', array(
            'event' => $event,
        ));
    }

}