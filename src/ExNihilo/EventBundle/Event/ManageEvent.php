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


    /**
     * Deletes an event entity.
     *
     */
    public function eventDelete ($request, $event)
    {
        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->em->remove($event);
            $em = $this->em->flush($event);
        }
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     */
    public function eventEdit ($request, $event)
    {

        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->formFactory->create('ExNihilo\EventBundle\Form\EventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->em->flush();
        }

        return [$event, $editForm, $deleteForm];

    }


    /**
     * Creates a form to delete a event entity.
     *
     * @param Event $event The article entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Event $event)
    {
        return $this->formFactory->createBuilder()
            ->setAction($this->router->generate('admin_event_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}