<?php

namespace ExNihilo\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function indexAction()
    {
        $manageArticle = $this->get('manage_article');
        $articles = $manageArticle->articleIndex();

        return $this->render('ExNihiloPlatformBundle:Front:index.html.twig', array(
            'articles'=> $articles
        ));
    }

    public function viewAction($id) {

        $manageArticle = $this->get('manage_article');
        $article = $manageArticle->ArticleView($id);

        return $this->render('ExNihiloBlogBundle:article:view.html.twig', array(
            'article' => $article,
        ));
    }
}
