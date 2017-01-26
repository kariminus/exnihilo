<?php

namespace ExNihilo\EventBundle\Event;

use Doctrine\ORM\EntityManager;
use ExNihilo\EventBundle\Entity\Event;

class ManageEvent
{

    private $em;

    private $formFactory;

    private $router;

    public function __construct(EntityManager $em, $formFactory, $router)
    {
        $this->em = $em;
        $this->formFactory = $formFactory;
        $this->router = $router;
    }

    /**
     * Lists all event entities.
     *
     */
    public function eventIndex()
    {
        $events = $this->em->getRepository('ExNihiloEventBundle:Event')->findAll();

        return $events;

    }

    public function eventNew($request)
    {
        $event = new Event();
        $form = $this->formFactory->create('ExNihilo\EventBundle\Form\EventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->em->persist($event);
            $em = $this->em->flush($event);
        }

        return [$event, $form];
    }

    /**
     * Finds and displays an event entity.
     *
     */
    public function eventShow ($event)
    {
        $deleteForm = $this->createDeleteForm($event);

        return [$event, $deleteForm];
    }

    public function eventView ($id)
    {

        $event = $this->em->getRepository('ExNihiloEventBundle:Event')->find($id);

        return $event;
    }


    /**
     * Deletes an event entity.
     *
     */
    public function eventDelete ($id)
    {
        $event = $this->em->getRepository('ExNihiloEventBundle:Event')->find($id);

        if ($event === null) {

            return $this->router->generate('admin_event_index');
        }

        $this->em->remove($event);
        $this->em->flush();

        return $this->router->generate('admin_event_index');
    }


    public function eventEdit ($request, $event)
    {

        $form = $this->formFactory->create('ExNihilo\EventBundle\Form\EventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
        }

        return [$event, $form];

    }

}