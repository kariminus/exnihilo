<?php

namespace ExNihilo\PlatformBundle\Character;

use Doctrine\ORM\EntityManager;
use ExNihilo\PlatformBundle\Entity\Classe;
use ExNihilo\PlatformBundle\Form\ClasseType;

class ManageClasse
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
     * Lists all classe entities.
     *
     */
    public function classeIndex()
    {
        return $this->em->getRepository('ExNihiloPlatformBundle:Classe')->findAll();

    }

    public function classeNew($request)
    {
        $classe = new Classe();
        $form = $this->formFactory->create('ExNihilo\PlatformBundle\Form\ClasseType', $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->em->persist($classe);
            $em = $this->em->flush($classe);
        }

        return [$classe, $form];
    }

    public function classeView ($id)
    {

        $classe = $this->em->getRepository('ExNihiloPlatformBundle:Classe')->find($id);

        return $classe;
    }

    /**
     * Deletes a classe entity.
     *
     */
    public function classeDelete ($id)
    {
        $classe = $this->em->getRepository('ExNihiloPlatformBundle:Classe')->find($id);

        if ($classe === null) {

            return $this->router->generate('admin_classe_index');
        }
        $this->em->remove($classe);
        $this->em->flush();

        return $this->router->generate('admin_classe_index');
    }

    /**
     * Displays a form to edit an existing classe entity.
     *
     */
    public function classeEdit ($request, $classe)
    {
        $form = $this->formFactory->create('ExNihilo\PlatformBundle\Form\ClasseType', $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
        }

        return [$classe, $form];

    }

}