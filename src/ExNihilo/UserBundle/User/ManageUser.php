<?php

namespace ExNihilo\UserBundle\User;

use Doctrine\ORM\EntityManager;
use ExNihilo\UserBundle\Entity\User;
use ExNihilo\UserBundle\Form\RegistrationType;

class ManageUser
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
     * Lists all user entities.
     *
     */
    public function userIndex ()
    {
        return $this->em->getRepository('ExNihiloUserBundle:User')->findAll();

    }


    /**
     * Deletes a user entity.
     *
     */
    public function userDelete ($id)
    {
        $user = $this->em->getRepository('ExNihiloUserBundle:User')->find($id);

        if ($user === null) {

            return $this->router->generate('admin_user_index');
        }
        $this->em->remove($user);
        $this->em->flush();

        return $this->router->generate('admin_user_index');
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     */
    public function userEdit ($request, $user)
    {

        $form = $this->formFactory->create('ExNihilo\UserBundle\Form\RegistrationType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
        }

        return [$user, $form];

    }

    public function getUsers($id)
    {
        return $this->em->getRepository('ExNihiloUserBundle:User')->getGuildMembers($id);

    }

}