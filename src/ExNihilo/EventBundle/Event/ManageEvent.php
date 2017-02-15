<?php

namespace ExNihilo\EventBundle\Event;

use Doctrine\ORM\EntityManager;
use ExNihilo\EventBundle\Entity\Event;
use ExNihilo\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class ManageEvent
{

    private $em;

    private $formFactory;

    private $router;

    protected $requestStack;

    protected $authorizationChecker;


    public function __construct(EntityManager $em, $formFactory, $router, RequestStack $requestStack, TokenStorage $tokenStorage, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->em = $em;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->requestStack = $requestStack;
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
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

    /**
     * Lists all event entities in the month.
     *
     */
    public function eventMonthIndex()
    {
        $events = $this->em->getRepository('ExNihiloEventBundle:Event')->getMonthEvents();

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

    public function eventView ($id)
    {
        $request = $this->requestStack->getCurrentRequest();
        $user = $this->tokenStorage->getToken()->getUser();
        $event = $this->em->getRepository('ExNihiloEventBundle:Event')->find($id);
        $users = $this->em->getRepository('ExNihiloEventBundle:Event')->getUserswithEvent($id);
        //$booked = 0;


        if ($this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $booked = $this->em->getRepository('ExNihiloEventBundle:Event')->checkEvent($id, $user->getId());
            $connected = 1;
        } else {
            $booked = 0;
            $connected = 0;
        }

            if ($request->isMethod('POST')) {

                try {
                    $event->addUser($user);
                    $user->addEvent($event);
                    $this->em->persist($event);
                    $this->em->persist($user);
                    $this->em->flush();
                } catch (\Exception $e){
                    $event->removeUser($user);
                    $user->removeEvent($event);
                }
            }

        return [$event, $users, $booked, $connected];
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