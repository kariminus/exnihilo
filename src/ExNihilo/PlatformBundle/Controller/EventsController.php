<?php


namespace ExNihilo\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class EventsController extends Controller
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

        return $this->render('ExNihiloPlatformBundle:Front:events.html.twig', array(
            'events'=> $result
        ));
    }

    public function viewAction($id)
    {

        return $this->render('ExNihiloEventBundle:event:view.html.twig', array(
            'event' => $this->get('manage_event')->EventView($id),
        ));
    }

}