<?php

namespace ExNihilo\UserBundle\User;

use Doctrine\ORM\EntityManager;
use ExNihilo\UserBundle\Entity\User;

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
        $users = $this->em->getRepository('ExNihiloUserBundle:User')->findAll();

        return $users;
    }


    /**
     * Finds and displays a user entity.
     *
     */
    public function userShow ($user)
    {
        $deleteForm = $this->createDeleteForm($user);

        return [$user, $deleteForm];
    }

    /**
     * Deletes a user entity.
     *
     */
    public function userDelete ($request, $user)
    {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->em->remove($user);
            $em = $this->em->flush($user);
        }
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     */
    public function userEdit ($request, $user)
    {

        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->formFactory->create('ExNihilo\UserBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->em->flush();
        }

        return [$user, $editForm, $deleteForm];

    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user)
    {
        return $this->formFactory->createBuilder()
            ->setAction($this->router->generate('admin_user_delete', array('id' => $user->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}