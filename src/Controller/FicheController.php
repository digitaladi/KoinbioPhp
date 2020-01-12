<?php

namespace App\Controller;

use App\Entity\Fiche;
use App\Form\FicheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class FicheController extends AbstractController
{
    /**
     * @Route("admin/fiche/index", name="admin_fiche_index")
     */
    public function index()
    {

        $fiches = $this->getDoctrine()->getRepository(Fiche::class)->findAll();
//        var_dump($fiches);
//        die("ok");
        return $this->render('admin/fiche/index.html.twig', array("fiches" => $fiches));
    }

    /**
     * @Route("admin/fiche/add", name="admin_fiche_add")
     */
    public function addFicheAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $fiche = new Fiche();
        $form =  $this->createForm(FicheType::class, $fiche);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($fiche);
            $em->flush();
            $this->addFlash('success', 'Fiche ajouté!');
            return $this->redirectToRoute("admin_fiche_index");
        }


        return $this->render("admin/fiche/add.html.twig", array("form_fiche" => $form->createView() ));


    }


    /**
     * @Route("admin/fiche/edit/{id}", name="admin_fiche_edit")
     */
    public function editficheAction(Fiche $fiche, Request $request){
        $em = $this->getDoctrine()->getManager();
        $form_edit =   $this->createForm(FicheType::class, $fiche);
        $form_edit->handleRequest($request);
        if($fiche){
            if($form_edit->isSubmitted() && $form_edit->isValid()){
                $em->persist($fiche);
                $em->flush();
                $this->addFlash('success', 'Fiche édité!');
                return $this->redirectToRoute("admin_fiche_index");
            }
        }else{
            throw new NotFoundHttpException("L'id n°". $fiche->getId()."n'existe pas");
        }
        return $this->render("admin/fiche/edit.html.twig", array("edit_form" => $form_edit->createView()));
    }

    /**
     * @Route("admin/fiche/show{id}", name="admin_fiche_show")
     */
    public function showFicheAction(Fiche $fiche){

        $fiche = $this->getDoctrine()->getRepository(Fiche::class)->find($fiche);
        if(!$fiche){

            throw new NotFoundHttpException("L'id n°". $fiche->getId()."n'existe pas");
        }


        return $this->render('admin/fiche/show.html.twig', array("fiche"=> $fiche));

    }

    /**
     * @Route("admin/fiche/delete{id}", name="admin_fiche_delete")
     */
    public function deleteAction(Fiche $fiche){
        $em =$this->getDoctrine()->getManager();
        $fiche =  $this->getDoctrine()->getRepository(Fiche::class)->find($fiche);

        if($fiche){
//    dump($fiche);
//    die();
            $em->remove($fiche);
            $em->flush();
            $this->addFlash('error', 'Fiche supprimé!');
            return $this->redirectToRoute("admin_fiche_index");
        }else{
            throw new NotFoundHttpException("L'id n°". $fiche->getId()."n'existe pas");
        }

    }




}


