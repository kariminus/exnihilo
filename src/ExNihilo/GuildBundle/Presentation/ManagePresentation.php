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
     * Finds and displays a presentation entity.
     *
     */
    public function presentationShow ($presentation)
    {
        $deleteForm = $this->createDeleteForm($presentation);

        return [$presentation, $deleteForm];
    }


    /**
     * Deletes a presentation entity.
     *
     */
    public function presentationDelete ($request, $presentation)
    {
        $form = $this->createDeleteForm($presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->em->remove($presentation);
            $em = $this->em->flush($presentation);
        }
    }

    /**
     * Displays a form to edit an existing presentation entity.
     *
     */
    public function presentationEdit ($request, $presentation)
    {

        $deleteForm = $this->createDeleteForm($presentation);
        $editForm = $this->formFactory->create('ExNihilo\GuildBundle\Form\PresentationType', $presentation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->em->flush();
        }

        return [$presentation, $editForm, $deleteForm];

    }


    /**
     * Creates a form to delete a presentation entity.
     *
     * @param Presentation $presentation The presentation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Presentation $presentation)
    {
        return $this->formFactory->createBuilder()
            ->setAction($this->router->generate('admin_presentation_delete', array('id' => $presentation->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}