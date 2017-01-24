<?php

namespace ExNihilo\BlogBundle\Article;

use Doctrine\ORM\EntityManager;
use ExNihilo\BlogBundle\Entity\Article;

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
        $articles = $this->em->getRepository('ExNihiloBlogBundle:Article')->findAll();

        return $articles;

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

    /**
     * Finds and displays a article entity.
     *
     */
    public function articleShow ($article)
    {
        $deleteForm = $this->createDeleteForm($article);

        return [$article, $deleteForm];
    }

    public function articleView ($id)
    {

        $article = $this->em->getRepository('ExNihiloBlogBundle:Article')->find($id);

        return $article;
    }

    /**
     * Deletes a article entity.
     *
     */
    public function articleDelete ($request, $article)
    {
        $form = $this->createDeleteForm($article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->em->remove($article);
            $em = $this->em->flush($article);
        }
    }

    /**
     * Displays a form to edit an existing article entity.
     *
     */
    public function articleEdit ($request, $article)
    {

        $deleteForm = $this->createDeleteForm($article);
        $editForm = $this->formFactory->create('ExNihilo\BlogBundle\Form\ArticleType', $article);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->em->flush();
        }

        return [$article, $editForm, $deleteForm];

    }


    /**
     * Creates a form to delete a article entity.
     *
     * @param Article $article The article entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Article $article)
    {
        return $this->formFactory->createBuilder()
            ->setAction($this->router->generate('admin_article_delete', array('id' => $article->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}