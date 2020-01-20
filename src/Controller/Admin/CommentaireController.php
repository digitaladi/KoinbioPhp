<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use Egulias\EmailValidator\Warning\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/admin/commentaire/index", name="admin_commentaire_index")
     */
    public function index()
    {

        $allCommentaires = $this->getDoctrine()->getRepository(Commentaire::class)->findAll();
        return $this->render('admin/commentaire/index.html.twig', [
            'allCommentaires' => $allCommentaires
        ]);
    }



/**
 * @Route("/admin/commentaire/add", name="admin_commentaire_add")
 */

public function add(Request $request){

    $user = $this->getUser();

    $commentaire = new Commentaire();
    $commentaire->setCreatedAt(new \DateTime());
    $em = $this->getDoctrine()->getManager();

    $form = $this->createForm(CommentaireType::class, $commentaire);
    $form->handleRequest($request); //ici on hidrate l'objet

//    dd($commentaire);
    if($form->isSubmitted() && $form->isValid()){
        $commentaire->setUser($user);
        $em->persist($commentaire);
        $em->flush();
        $this->addFlash("success", "Le commentaire a été ajouté");
      return  $this->redirectToRoute('admin_commentaire_index');
    }

   return $this->render('admin/commentaire/add.html.twig', array('form'=> $form->createView()));


}

    /**
     * @Route("/admin/commentaire/delete/{id}", name="admin_commentaire_delete")
     */
public function delete(Commentaire $commentaire){
    $em = $this->getDoctrine()->getManager();
    $commentaire = $this->getDoctrine()->getRepository(Commentaire::class)->find($commentaire);
    if(!$commentaire){
        throw new NotFoundHttpException("Ce commentaire n'existe pas");
    }
    $em->remove($commentaire);
    $em->flush();
    $this->addFlash('error', 'Le commentaire a été supprimé');
    return $this->redirectToRoute('admin_commentaire_index');

}

    /**
     * @Route("/admin/commentaire/show/{id}", name="admin_commentaire_show")
     */
public function show(Commentaire $commentaire){
 $commentaire = $this->getDoctrine()->getRepository(Commentaire::class)->find($commentaire);

 if(!$commentaire){
     throw new NotFoundHttpException("Ce commentaire n'existe pas");
 }

     return $this->render('admin/commentaire/show.html.twig', array('commentaire'=> $commentaire));


}


    /**
     * @Route("/admin/commentaire/edit/{id}", name="admin_commentaire_edit")
     */
public function edit(Request $request,  Commentaire $commentaire){
    $user = $this->getUser();
    $em = $this->getDoctrine()->getManager();
    $commentaire =  $this->getDoctrine()->getRepository(Commentaire::class)->find($commentaire);
    $form_edit = $this->createForm(CommentaireType::class, $commentaire);
    $form_edit->handleRequest($request);

    if($form_edit->isSubmitted() && $form_edit->isValid()){
        $commentaire->setUser($user);
        $em->persist($commentaire);
        $em->flush();
        $this->addFlash("notice", "Le commentaire a été modifié");
        return $this->redirectToRoute("admin_commentaire_index");
    }

    return $this->render('admin/commentaire/edit.html.twig', array('form_edit'=>$form_edit->createView()));
}



}