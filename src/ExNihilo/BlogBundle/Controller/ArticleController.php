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

    public function indexAction()
    {
        $manageArticle = $this->get('manage_article');
        $articles = $manageArticle->articleIndex();

        return $this->render('ExNihiloBlogBundle:article:index.html.twig', array(
            'articles' => $articles,
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


    public function showAction(Article $article)
    {
        $manageArticle = $this->get('manage_article');
        $array = $manageArticle->ArticleShow($article);

        return $this->render('ExNihiloBlogBundle:article:show.html.twig', array(
            'article' => $array[0],
            'delete_form' => $array[1]->createView(),
        ));
    }


    public function editAction(Request $request, Article $article)
    {

        $manageArticle = $this->get('manage_article');
        $array = $manageArticle->articleEdit($request, $article);

        return $this->render('ExNihiloBlogBundle:article:edit.html.twig', array(
            'article' => $array[0],
            'edit_form' => $array[1]->createView(),
            'delete_form' => $array[2]->createView(),
        ));
    }

    public function deleteAction(Request $request, Article $article)
    {
        $manageArticle = $this->get('manage_article');
        $manageArticle->articleDelete($request, $article);

        return $this->redirectToRoute('admin_article_index');
    }

}
