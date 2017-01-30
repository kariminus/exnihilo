<?php

namespace ExNihilo\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
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
            $request->query->getInt('limit', 5)

        );

        return $this->render('ExNihiloPlatformBundle:Front:index.html.twig', array(
            'articles'=> $result
        ));
    }

    public function viewAction($id)
    {
        return $this->render('ExNihiloBlogBundle:article:view.html.twig', array(
            'article' => $this->get('manage_article')->articleView($id),
        ));
    }
}
