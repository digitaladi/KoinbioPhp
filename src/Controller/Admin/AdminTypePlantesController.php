<?php

namespace App\Controller\Admin;

use App\Entity\TypePlantes;
use App\Form\TypePlantesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminTypePlantesController extends AbstractController
{
    /**
     * @Route("/type/plantes", name="type_plantes_index")
     */
    public function index()
    {

        $typePlantes = $this->getDoctrine()->getRepository(TypePlantes::class)->findAll();
        return $this->render('admin/type_plantes/index.html.twig', [
           'typePlantes'  => $typePlantes,
        ]);
    }


    /**
     * @Route("/admin/type_plantes_add", name="admin_type_plantes_add")
     */

    public function addAction(Request $request){

        $typePlante = new TypePlantes();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(TypePlantesType::class, $typePlante);
        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $typePlante contient les valeurs entrées dans le formulaire par le visiteur
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em->persist($typePlante);
            $em->flush();
            $this->addFlash("success", "Le type de plante à été ajouté");
            return $this->redirectToRoute("type_plantes_index");
        }

        return $this->render("admin/type_plantes/add.html.twig", array("form" => $form->createView()));

    }

    /**
     * @Route("/admin/type_plantes_show/{id}", name="admin_type_plantes_show")
     */

    public function show (TypePlantes $typePlantes){

        $typePlante = $this->getDoctrine()->getRepository(TypePlantes::class)->find($typePlantes);

        if(!$typePlante){
            throw $this->createNotFoundException("L'id n°". $typePlantes->getId()."n'existe pas");
        }

        return $this->render("admin/type_plantes/show.html.twig", array("typePlante" => $typePlante));

    }




    /**
     * @Route("/admin/type_plantes_adit/{id}", name="admin_type_plante_edit")
     */
    public function edit(TypePlantes $typePlantes, Request $request){
        $em = $this->getDoctrine()->getManager();
        $form_edit =   $this->createForm(TypePlantesType::class, $typePlantes);
        $form_edit->handleRequest($request);
        if($typePlantes){
            if($form_edit->isSubmitted() && $form_edit->isValid()){
                $em->persist($typePlantes);
                $em->flush();
                $this->addFlash('success', 'Type de plante édité!');
                return $this->redirectToRoute("type_plantes_index");
            }
        }else{
            throw $this->createNotFoundException("L'id n°". $typePlantes->getId()."n'existe pas");
        }
        return $this->render("admin/type_plantes/edit.html.twig", array("edit_form" => $form_edit->createView()));
    }


    /**
     * @Route("admin/type_plantes_delete/{id}",name="admin_type_plantes_delete")
     */

public function delete(TypePlantes $typePlantes){
        $em = $this->getDoctrine()->getManager();
        $typePlantes = $this->getDoctrine()->getRepository(TypePlantes::class)->find($typePlantes);
        if($typePlantes){
            $em->remove($typePlantes);
            $em->flush();
            $this->addFlash("error", "le type de plante a été supprimé");
          return  $this->redirectToRoute("type_plantes_index");
        }else{
            throw $this->createNotFoundException("L'id n°". $typePlantes->getId()."n'existe pas");
        }

}












}


