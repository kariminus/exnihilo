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

    public function indexAction()
    {
        $manageClasse = $this->get('manage_classe');

        return $this->render('ExNihiloPlatformBundle:classe:index.html.twig', array(
            'classes' => $manageClasse->classeIndex(),
        ));
    }


    public function newAction(Request $request)
    {
        $manageClasse = $this->get('manage_classe');
        $array = $manageClasse->classeNew($request);

        return $this->render('ExNihiloPlatformBundle:classe:new.html.twig', array(
            'classe' => $array[0],
            'form' => $array[1]->createView(),
        ));
    }


    public function viewAction($id)
    {
        $manageClasse = $this->get('manage_classe');

        return $this->render('ExNihiloplatformBundle:classe:view.html.twig', array(
            'classe' => $manageClasse->classeView($id),
        ));
    }


    public function editAction(Request $request, Classe $classe)
    {

        $manageClasse = $this->get('manage_classe');
        $array = $manageClasse->classeEdit($request, $classe);

        return $this->render('ExNihiloPlatformBundle:classe:edit.html.twig', array(
            'classe' => $array[0],
            'edit_form' => $array[1]->createView(),
        ));
    }

    public function deleteAction($id)
    {
        $manageClasse = $this->get('manage_classe');
        $manageClasse->classeDelete($id);

        return $this->redirectToRoute('admin_classe_index');
    }

}
