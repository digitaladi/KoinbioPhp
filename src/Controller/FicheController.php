<?php

namespace App\Controller;

use App\Entity\Fiche;
use App\Form\FicheType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FicheController extends AbstractController
{
    /**
     * @Route("admin/fiche/index", name="admin_fiche_index")
     */
    public function index()
    {
        return $this->render('admin/fiche/index.html.twig');
    }

    /**
     * @Route("admin/fiche/add", name="admin_fiche_add")
     */
    public function addFiche(Request $request){
    $em = $this->getDoctrine()->getManager();
    $fiche = new Fiche();
   $form =  $this->createForm(FicheType::class, $fiche);

   $form->handleRequest($request);

   if($form->isSubmitted() && $form->isValid()){
       $em->persist($fiche);
       $em->flush();
       return $this->redirectToRoute("admin_fiche_index");
   }


return $this->render("admin/fiche/add.html.twig", array("form_fiche" => $form->createView() ));


    }



}
