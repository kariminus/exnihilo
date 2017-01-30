<?php

namespace ExNihilo\BlogBundle\Controller;

use ExNihilo\BlogBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ExNihilo\BlogBundle\Form\CommentType;

/**
 * Comment controller.
 *
 */
class CommentController extends Controller
{
    public function indexAction(Request $request)
    {

        $comments = $this->get('manage_comment')->commentIndex();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $comments,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)

        );

        return $this->render('ExNihiloBlogBundle:comment:index.html.twig', array(
            'comments' => $result,
        ));

    }


    public function newAction($articleId)
    {
        $array = $this->get('manage_comment')->commentNew($articleId);

        return $this->render('ExNihiloBlogBundle:Comment:form.html.twig', array(
            'comment' => $array[0],
            'form'   => $array[1]->createView()
        ));
    }

    public function createAction(Request $request, $articleId)
    {
        $array = $this->get('manage_comment')->commentNew($request, $articleId);

        return $this->render('ExNihiloBlogBundle:Comment:create.html.twig', array(
            'comment' => $array[0],
            'form'   => $array[1]->createView()
        ));
    }


    public function editAction(Request $request, Comment $comment)
    {
        $array = $this->get('manage_comment')->commentEdit($request, $comment);

        return $this->render('ExNihiloBlogBundle:comment:edit.html.twig', array(
            'comment' => $array[0],
            'edit_form' => $array[1]->createView(),
        ));
    }


    public function deleteAction($id)
    {
        $this->get('manage_comment')->commentDelete($id);

        return $this->redirectToRoute('admin_comment_index');
    }

    protected function getArticle($articleId)
    {
        $em = $this->getDoctrine()
            ->getEntityManager();

        $article = $em->getRepository('ExNihiloBlogBundle:Article')->find($articleId);

        if (!$article) {
            throw $this->createNotFoundException('Article introuvable');
        }

        return $article;
    }
}
