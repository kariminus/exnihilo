<?php

namespace ExNihilo\EventBundle\Event;

use Doctrine\ORM\EntityManager;
use ExNihilo\EventBundle\Entity\Event;
use ExNihilo\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\RequestStack;

class ManageEvent
{

    private $em;

    private $formFactory;

    private $router;

    protected $requestStack;

    public function __construct(EntityManager $em, $formFactory, $router, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->requestStack = $requestStack;
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
        $form = $this->formFactory
            ->create('ExNihilo\EventBundle\Form\EventType', $event)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($event);
            $this->em->flush($event);
        }

        return [$event, $form];
    }

    /**
     * Finds and displays an event entity.
     *
     */
    public function eventShow ($event)
    {

        return [$event, $this->createDeleteForm($event)];
    }

    public function eventView ($id, $user)
    {
        $request = $this->requestStack->getCurrentRequest();
        $event = $this->em->getRepository('ExNihiloEventBundle:Event')->find($id);
        $users = $this->em->getRepository('ExNihiloEventBundle:Event')->getUserswithEvent($id);

        $booked = $this->em->getRepository('ExNihiloEventBundle:Event')->checkEvent($id, $user->getId());


        if ($request->isMethod('POST')) {

            $event->addUser($user);
            $user->addEvent($event);
            $this->em->persist($event);
            $this->em->persist($user);
            $this->em->flush();

        }

        return [$event, $users, $booked];
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

        $form = $this->formFactory
            ->create('ExNihilo\EventBundle\Form\EventType', $event)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
        }

        return [$event, $form];

    }

}