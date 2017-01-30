<?php

namespace ExNihilo\BlogBundle\Controller;

use ExNihilo\BlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{

    public function indexAction(Request $request)
    {
        $articles = $this->get('manage_article')->articleIndex();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $articles,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)

        );

        return $this->render('ExNihiloBlogBundle:article:index.html.twig', array(
            'articles' => $result,
        ));
    }


    public function newAction(Request $request)
    {
        $manageArticle = $this->get('manage_article');
        $array = $manageArticle->articleNew($request);

        return $this->render('ExNihiloBlogBundle:article:new.html.twig', array(
            'article' => $array[0],
            'form' => $array[1]->createView(),
        ));
    }


    public function viewAction(Request $request, $id)
    {
        $manageArticle = $this->get('manage_article');
        $array = $manageArticle->ArticleView($request, $id);

        return $this->render('ExNihiloBlogBundle:article:view.html.twig', array(
            'article'  => $array[0],
            'comments' => $array[1],
            'form'     => $array[2]->createView(),
        ));
    }


    public function editAction(Request $request, Article $article)
    {

        $manageArticle = $this->get('manage_article');
        $array = $manageArticle->articleEdit($request, $article);

        return $this->render('ExNihiloBlogBundle:article:edit.html.twig', array(
            'article' => $array[0],
            'edit_form' => $array[1]->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $manageArticle = $this->get('manage_article');
        $manageArticle->articleDelete($id);

        return $this->redirectToRoute('admin_article_index');
    }

}
