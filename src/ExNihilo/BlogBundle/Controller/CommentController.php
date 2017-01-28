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
    public function indexAction()
    {

        $manageComment = $this->get('manage_comment');
        $comments = $manageComment->commentIndex();

        return $this->render('ExNihiloBlogBundle:comment:index.html.twig', array(
            'comments' => $comments,
        ));

    }


    public function newAction($articleId)
    {
        $manageComment = $this->get('manage_comment');
        $array = $manageComment->commentNew($articleId);

        return $this->render('ExNihiloBlogBundle:Comment:form.html.twig', array(
            'comment' => $array[0],
            'form'   => $array[1]->createView()
        ));
    }

    public function createAction(Request $request, $articleId)
    {
        $manageComment = $this->get('manage_comment');
        $array = $manageComment->commentNew($request, $articleId);

        return $this->render('ExNihiloBlogBundle:Comment:create.html.twig', array(
            'comment' => $array[0],
            'form'   => $array[1]->createView()
        ));
    }


    public function editAction(Request $request, Comment $comment)
    {

        $manageComment = $this->get('manage_comment');
        $array = $manageComment->commentEdit($request, $comment);

        return $this->render('ExNihiloBlogBundle:comment:edit.html.twig', array(
            'comment' => $array[0],
            'edit_form' => $array[1]->createView(),
        ));
    }


    public function deleteAction($id)
    {
        $manageComment = $this->get('manage_comment');
        $manageComment->commentDelete($id);

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
