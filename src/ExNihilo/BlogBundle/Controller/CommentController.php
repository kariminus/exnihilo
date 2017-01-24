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


    public function newAction(Request $request, $articleId)
    {
        $manageComment = $this->get('manage_comment');
        $array = $manageComment->commentNew($request, $articleId);

        return $this->render('ExNihiloBlogBundle:Comment:new.html.twig', array(
            'comment' => $array[0],
            'form'   => $array[1]->createView()
        ));
    }



    public function showAction(Comment $comment)
    {
        $manageComment = $this->get('manage_comment');
        $array = $manageComment->commentShow($comment);

        return $this->render('ExNihiloBlogBundle:comment:show.html.twig', array(
            'comment' => $array[0],
            'delete_form' => $array[1]->createView(),
        ));
    }


    public function editAction(Request $request, Comment $comment)
    {

        $manageComment = $this->get('manage_comment');
        $array = $manageComment->commentEdit($request, $comment);

        return $this->render('ExNihiloBlogBundle:comment:edit.html.twig', array(
            'comment' => $array[0],
            'edit_form' => $array[1]->createView(),
            'delete_form' => $array[2]->createView(),
        ));
    }


    public function deleteAction(Request $request, Comment $comment)
    {
        $manageComment = $this->get('manage_comment');
        $manageComment->commentDelete($request, $comment);

        return $this->redirectToRoute('admin_comment_index');
    }
}
