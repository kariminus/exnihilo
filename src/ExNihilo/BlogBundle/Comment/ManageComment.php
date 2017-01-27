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
        return $this->em->getRepository('ExNihiloBlogBundle:Comment')->findAll();

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
     * Deletes a comment entity.
     *
     */
    public function commentDelete ($id)
    {
        $comment = $this->em->getRepository('ExNihiloBlogBundle:Comment')->find($id);

        if ($comment === null) {

            return $this->router->generate('admin_comment_index');
        }

        $this->em->remove($comment);
        $this->em->flush();

        return $this->router->generate('admin_comment_index');
    }

    /**
     * Displays a form to edit an existing comment entity.
     *
     */
    public function commentEdit ($request, $comment)
    {

        $form = $this->formFactory->create('ExNihilo\BlogBundle\Form\CommentType', $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
        }

        return [$comment, $form];

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