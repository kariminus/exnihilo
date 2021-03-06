<?php

namespace ExNihilo\PlatformBundle\Controller;

use ExNihilo\PlatformBundle\Entity\Race;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Race controller.
 *
 */
class RaceController extends Controller
{

    public function indexAction(Request $request)
    {
        $races = $this->get('manage_race')->raceIndex();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator  = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $races,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)

        );

        return $this->render('ExNihiloPlatformBundle:race:index.html.twig', array(
            'races' => $result,
        ));
    }


    public function newAction(Request $request)
    {
        $array = $this->get('manage_race')->classeNew($request);

        return $this->render('ExNihiloPlatformBundle:race:new.html.twig', array(
            'race' => $array[0],
            'form' => $array[1]->createView(),
        ));
    }


    public function viewAction($id)
    {

        return $this->render('ExNihiloplatformBundle:race:view.html.twig', array(
            'race' => $this->get('manage_race')->raceView($id),
        ));
    }


    public function editAction(Request $request, Race $race)
    {
        $array = $this->get('manage_race')->raceEdit($request, $race);

        return $this->render('ExNihiloPlatformBundle:race:edit.html.twig', array(
            'race' => $array[0],
            'edit_form' => $array[1]->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $this->get('manage_race')->raceDelete($id);

        return $this->redirectToRoute('admin_race_index');
    }

}
