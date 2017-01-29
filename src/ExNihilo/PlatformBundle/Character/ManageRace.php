<?php

namespace ExNihilo\PlatformBundle\Character;

use Doctrine\ORM\EntityManager;
use ExNihilo\PlatformBundle\Entity\Race;
use ExNihilo\PlatformBundle\Form\RaceType;

class ManageRace
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
     * Lists all race entities.
     *
     */
    public function raceIndex()
    {
        return $this->em->getRepository('ExNihiloPlatformBundle:Race')->findAll();

    }

    public function raceNew($request)
    {
        $race = new Race();
        $form = $this->formFactory->create('ExNihilo\PlatformBundle\Form\RaceType', $race);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->em->persist($race);
            $em = $this->em->flush($race);
        }

        return [$race, $form];
    }

    public function raceView ($id)
    {

        return $this->em->getRepository('ExNihiloPlatformBundle:Race')->find($id);

    }

    /**
     * Deletes a race entity.
     *
     */
    public function raceDelete ($id)
    {
        $race = $this->em->getRepository('ExNihiloPlatformBundle:Race')->find($id);

        if ($race === null) {

            return $this->router->generate('admin_race_index');
        }
        $this->em->remove($race);
        $this->em->flush();

        return $this->router->generate('admin_race_index');
    }

    /**
     * Displays a form to edit an existing race entity.
     *
     */
    public function raceEdit ($request, $race)
    {
        $form = $this->formFactory->create('ExNihilo\PlatformBundle\Form\RaceType', $race);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
        }

        return [$race, $form];

    }


}