<?php

namespace ExNihilo\BlogBundle\Comment;

use Doctrine\ORM\EntityManager;
use ExNihilo\BlogBundle\Entity\Comment;

class ManageComment
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
     * Lists all comment entities.
     *
     */
    public function commentIndex ()
    {
        $comments = $this->em->getRepository('ExNihiloBlogBundle:Comment')->findAll();

        return $comments;
    }

    public function commentNew($request, $articleId)
    {
        $article = $this->getArticle($articleId);

        $comment = new Comment();
        $comment->setArticle($article);
        $form   = $this->formFactory->create('ExNihilo\BlogBundle\Form\CommentType', $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->em->persist($comment);
            $em = $this->em->flush($comment);
        }

        return [$comment, $form];
    }


    /**
     * Finds and displays a comment entity.
     *
     */
    public function commentShow ($comment)
    {
        $deleteForm = $this->createDeleteForm($comment);

        return [$comment, $deleteForm];
    }

    /**
     * Deletes a comment entity.
     *
     */
    public function commentDelete ($request, $comment)
    {
        $form = $this->createDeleteForm($comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->em->remove($comment);
            $em = $this->em->flush($comment);
        }
    }

    /**
     * Displays a form to edit an existing comment entity.
     *
     */
    public function commentEdit ($request, $comment)
    {

        $deleteForm = $this->createDeleteForm($comment);
        $editForm = $this->formFactory->create('ExNihilo\BlogBundle\Form\CommentType', $comment);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->em->flush();
        }

        return [$comment, $editForm, $deleteForm];

    }

    /**
     * Creates a form to delete a comment entity.
     *
     * @param Comment $comment The comment entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Comment $comment)
    {
        return $this->formFactory->createBuilder()
            ->setAction($this->router->generate('admin_comment_delete', array('id' => $comment->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    protected function getArticle($articleId)
    {

        $article = $this->em->getRepository('ExNihiloBlogBundle:Article')->find($articleId);

        if (!$article) {
            throw $this->createNotFoundException('Article introuvable');
        }

        return $article;
    }
}