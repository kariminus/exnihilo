<?php

namespace ExNihilo\EventBundle\Controller;

use ExNihilo\EventBundle\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{

    public function indexAction(Request $request)
    {
        $events = $this->get('manage_event')->eventIndex();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $events,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)

        );

        return $this->render('ExNihiloEventBundle:event:index.html.twig', array(
            'events' => $result,
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


    public function viewAction($id, UserInterface $user)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $manageEvent = $this->get('manage_event');
        $array = $manageEvent->EventView($id, $user);

        return $this->render('ExNihiloEventBundle:event:view.html.twig', array(
            'event' => $array[0],
            'users' => $array[1]
        ));
    }


    public function editAction(Request $request, Event $event)
    {

        $manageEvent = $this->get('manage_event');
        $array = $manageEvent->eventEdit($request, $event);

        return $this->render('ExNihiloEventBundle:event:edit.html.twig', array(
            'article' => $array[0],
            'edit_form' => $array[1]->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $manageEvent = $this->get('manage_event');
        $manageEvent->eventDelete($id);

        return $this->redirectToRoute('admin_event_index');
    }

    public function bookingAction()
    {
        $manageEvent = $this->get('manage_event');
        $manageEvent->eventBooking();

        return $this->redirectToRoute('event_view');
    }

}
