<?php

namespace ExNihilo\GuildBundle\Presentation;

use Doctrine\ORM\EntityManager;
use ExNihilo\GuildBundle\Entity\Presentation;

class ManagePresentation
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
     * Lists all presentation entities.
     *
     */
    public function presentationIndex()
    {
        $presentations = $this->em->getRepository('ExNihiloGuildBundle:Presentation')->findAll();

        return $presentations;

    }

    public function presentationNew($request)
    {
        $presentation = new Presentation();
        $form = $this->formFactory->create('ExNihilo\GuildBundle\Form\PresentationType', $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->em->persist($presentation);
            $em = $this->em->flush($presentation);
        }

        return [$presentation, $form];
    }


    /**
     * Displays a form to edit an existing presentation entity.
     *
     */
    public function presentationEdit ($request, $presentation)
    {

        $form = $this->formFactory->create('ExNihilo\GuildBundle\Form\PresentationType', $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
        }

        return [$presentation, $form];

    }

}