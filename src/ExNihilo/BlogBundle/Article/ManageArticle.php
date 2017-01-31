<?php

namespace ExNihilo\BlogBundle\Article;

use Doctrine\ORM\EntityManager;
use ExNihilo\BlogBundle\Entity\Article;
use ExNihilo\BlogBundle\Entity\Comment;
use ExNihilo\UserBundle\Entity\User;


class ManageArticle
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
     * Lists all article entities.
     *
     */
    public function articleIndex()
    {
        return $this->em->getRepository('ExNihiloBlogBundle:Article')->findAll();

    }

    public function articleNew($request)
    {
        $article = new Article();
        $form = $this->formFactory
            ->create('ExNihilo\BlogBundle\Form\ArticleType', $article)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($article);
            $this->em->flush();
        }

        return [$article, $form];
    }

    public function articleView ($request, $user, $id)
    {
        $article = $this->em->getRepository('ExNihiloBlogBundle:Article')->find($id);
        $articleNext = $this->em->getRepository('ExNihiloBlogBundle:Article')->find($id+1);
        $articleBefore = $this->em->getRepository('ExNihiloBlogBundle:Article')->find($id-1);

        if ($articleNext == null ) {
            $next = 0;
            $nextTitle = 0;
        } else {
            $next = $articleNext->getId();
            $nextTitle = $articleNext->getTitle();
        }

        if ($articleBefore == null ) {
            $before = 0;
            $beforeTitle = 0;
        } else {
            $before = $articleBefore->getId();
            $beforeTitle = $articleBefore->getTitle();
        }

        $comment = new Comment();
        $comment->setArticle($article);
        $comment->setAuthor($user->getUsername());
        $form = $this->formFactory
            ->create('ExNihilo\BlogBundle\Form\CommentType', $comment)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($comment);
            $this->em->flush();
        }



        $comments = $this->em->getRepository('ExNihiloBlogBundle:Comment')
            ->getCommentsForArticle($article->getId());




        return [$article, $comments, $form, $next, $before, $nextTitle, $beforeTitle];
    }

    /**
     * Deletes a article entity.
     *
     */
    public function articleDelete ($id)
    {
        $article = $this->em->getRepository('ExNihiloBlogBundle:Article')->find($id);

        if ($article === null) {

            return $this->router->generate('admin_article_index');
        }
        $this->em->remove($article);
        $this->em->flush();

        return $this->router->generate('admin_article_index');
    }

    /**
     * Displays a form to edit an existing article entity.
     *
     */
    public function articleEdit ($request, $article)
    {
        $form = $this->formFactory
            ->create('ExNihilo\BlogBundle\Form\ArticleType', $article)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
        }

        return [$article, $form];

    }

}