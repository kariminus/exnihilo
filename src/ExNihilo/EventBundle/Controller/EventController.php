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
        $array = $this->get('manage_event')->eventNew($request);

        return $this->render('ExNihiloEventBundle:event:new.html.twig', array(
            'event' => $array[0],
            'form' => $array[1]->createView(),
        ));
    }


    public function viewAction($id)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $array = $this->get('manage_event')->EventView($id, $user);

        return $this->render('ExNihiloEventBundle:event:view.html.twig', array(
            'event' => $array[0],
            'users' => $array[1],
            'booked' => $array[1]
        ));
    }


    public function editAction(Request $request, Event $event)
    {
        $array = $this->get('manage_event')->eventEdit($request, $event);

        return $this->render('ExNihiloEventBundle:event:edit.html.twig', array(
            'article' => $array[0],
            'edit_form' => $array[1]->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $this->get('manage_event')->eventDelete($id);

        return $this->redirectToRoute('admin_event_index');
    }

    public function bookingAction()
    {
        $this->get('manage_event')->eventBooking();

        return $this->redirectToRoute('event_view');
    }

}
