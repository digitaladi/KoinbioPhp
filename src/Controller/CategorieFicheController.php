<?php

namespace App\Controller;

use App\Entity\CategorieFiche;
use App\Form\CategorieFicheType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategorieFicheController extends AbstractController
{
    /**
     * @Route("admin/categorie/fiche/index", name="admin_categorie_fiche_index")
     */
    public function index()
    {
       $categorie_fiches =  $this->getDoctrine()->getRepository(CategorieFiche::class)->findAll();

        return $this->render('admin/categorie_fiche/index.html.twig', [
        "categorie_fiches"=> $categorie_fiches
        ]);
    }

    /**
     * @Route("/admin/categorie/fiche/add", name="admin_categorie_fiche_add")
     */
    public  function add(Request $request){

        $categorie_fiche = new CategorieFiche();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(CategorieFicheType::class, $categorie_fiche);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($categorie_fiche);
            $em->flush();
            $this->addFlash("success", "Catégorie de fiche ajouté");
           return $this->redirectToRoute("admin_categorie_fiche_index");
        }

        return $this->render("admin/categorie_fiche/add.html.twig", array("form" => $form->createView()));

    }


    /**
     * @Route("/admin/categorie/fiche/{id}", name="admin_categorie_fiche_show")
     */
    public function show(CategorieFiche $categorieFiche){

        $categorieFiche = $this->getDoctrine()->getRepository(CategorieFiche::class)->find($categorieFiche);

        if(!$categorieFiche){
            throw $this->createNotFoundException("L'id n°". $categorieFiche->getId()."n'existe pas");
        }

     return   $this->render("admin/categorie_fiche/show.html.twig", array("categorieFiche"=>$categorieFiche));

    }


    /**
     * @Route("/admin/categorie/fiche/edit/{id}", name="admin_fiche_categorie_edit")
     */
    public function edit(CategorieFiche $categorieFiche, Request $request){
        $em = $this->getDoctrine()->getManager();
        $form_edit =   $this->createForm(CategorieFicheType::class, $categorieFiche);
        $form_edit->handleRequest($request);
        if($categorieFiche){
            if($form_edit->isSubmitted() && $form_edit->isValid()){
                $em->persist($categorieFiche);
                $em->flush();
                $this->addFlash('success', 'Catégorie de fiche édité!');
                return $this->redirectToRoute("admin_categorie_fiche_index");
            }
        }else{
            throw $this->createNotFoundException("L'id n°". $categorieFiche->getId()."n'existe pas");
        }
        return $this->render("admin/categorie_fiche/edit.html.twig", array("edit_form" => $form_edit->createView()));
    }




    /**
     * @Route("/admin/categorie/fiche/delete/{id}", name="admin_fiche_categorie_delete",requirements={"id":"\d+"})
     */
    public function delete(CategorieFiche $categorieFiche){
 //       dump($categorieFiche);
//        die();
        $em =$this->getDoctrine()->getManager();
        $categorieFiche =  $this->getDoctrine()->getRepository(CategorieFiche::class)->find($categorieFiche);



            $em->remove($categorieFiche);
            $em->flush();
            $this->addFlash('error', 'Catégorie de fiche supprimée !');
            return $this->redirectToRoute("admin_categorie_fiche_index");


    }





}
