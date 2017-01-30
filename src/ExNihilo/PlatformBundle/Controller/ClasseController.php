<?php

namespace ExNihilo\PlatformBundle\Controller;

use ExNihilo\PlatformBundle\Entity\Classe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Classe controller.
 *
 */
class ClasseController extends Controller
{

    public function indexAction(Request $request)
    {
        $classes = $this->get('manage_classe')->classeIndex();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $classes,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)

        );

        return $this->render('ExNihiloPlatformBundle:classe:index.html.twig', array(
            'classes' => $result,
        ));
    }


    public function newAction(Request $request)
    {
        $array = $this->get('manage_classe')->classeNew($request);

        return $this->render('ExNihiloPlatformBundle:classe:new.html.twig', array(
            'classe' => $array[0],
            'form' => $array[1]->createView(),
        ));
    }


    public function viewAction($id)
    {

        return $this->render('ExNihiloplatformBundle:classe:view.html.twig', array(
            'classe' => $this->get('manage_classe')->classeView($id),
        ));
    }


    public function editAction(Request $request, Classe $classe)
    {

        $array = $this->get('manage_classe')->classeEdit($request, $classe);

        return $this->render('ExNihiloPlatformBundle:classe:edit.html.twig', array(
            'classe' => $array[0],
            'edit_form' => $array[1]->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $this->get('manage_classe')->classeDelete($id);

        return $this->redirectToRoute('admin_classe_index');
    }

}
