<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/admin/commentaire/index", name="admin_commentaire_index")
     */
    public function index()
    {
        return $this->render('admin/commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }



/**
 * @Route("/admin/commentaire/add", name="admin_commentaire_add")
 */

public function add(Request $request){

    $commentaire = new Commentaire();
    $em = $this->getDoctrine()->getManager();
    $form = $this->createForm(CommentaireType::class, $commentaire);
    $form->handleRequest($request); //ici on hidrate l'objet
    if($form->isSubmitted() && $form->isValid()){
        $em->persist($commentaire);
        $em->flush();
        $this->redirectToRoute('admin_commentaire_index');
    }

   return $this->render('admin/commentaire/add.html.twig', array('form'=> $form->createView()));


}

    /**
     * @Route("/admin/commentaire/delete/{id}", name="admin_commentaire_delete")
     */
public function delete(){
    
}

    /**
     * @Route("/admin/commentaire/show/{id}", name="admin_commentaire_show")
     */
public function show(){

}


    /**
     * @Route("/admin/commentaire/edit", name="admin_commentaire_edit")
     */
public function edit(){

}



}