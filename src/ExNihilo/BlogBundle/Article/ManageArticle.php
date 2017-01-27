<?php

namespace ExNihilo\BlogBundle\Article;

use Doctrine\ORM\EntityManager;
use ExNihilo\BlogBundle\Entity\Article;
use ExNihilo\BlogBundle\Form\ArticleType;

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
        $form = $this->formFactory->create('ExNihilo\BlogBundle\Form\ArticleType', $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->em->persist($article);
            $em = $this->em->flush($article);
        }

        return [$article, $form];
    }

    public function articleView ($id)
    {

        $article = $this->em->getRepository('ExNihiloBlogBundle:Article')->find($id);

        $comments = $this->em->getRepository('ExNihiloBlogBundle:Comment')
            ->getCommentsForArticle($article->getId());


        return [$article, $comments];
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
        $form = $this->formFactory->create('ExNihilo\BlogBundle\Form\ArticleType', $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->flush();
        }

        return [$article, $form];

    }

}