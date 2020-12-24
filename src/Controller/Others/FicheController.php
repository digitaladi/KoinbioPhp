<?php

namespace App\Controller\Others;

use App\Entity\Commentaire;
use App\Entity\Fiche;
use App\Entity\User;
use App\Form\CommentaireType;
use App\Form\FicheType;
use DateTime;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class FicheController extends AbstractController
{
    /**
     * @Route("/mes/fiches", name="mes_fiches")
     */
    public function index()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $fiches =   $em->getRepository(Fiche::class)->getFicheByUser($user);

//dd($fiches);
        return $this->render('fiche/index.html.twig', array('fiches' => $fiches));
    }


    /**
     * @Route("add/fiche", name="add_fiche")
     */
    public function add(Request $request){
$user = $this->getUser();
$fiche = new Fiche();
$em = $this->getDoctrine()->getManager();
$form = $this->createForm(FicheType::class,$fiche);
//$form->remove("type");

//        $date = new DateTime();
//       $date_day = $date->format('Y-m-d H:i:s');
        $fiche->setCreateAt(new DateTime('now',new \DateTimeZone('Europe/Paris')));
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){

                $fiche->setUser($user); // user dedans
//                dd($fiche);
                $em->persist($fiche);
                $em->flush();
                $this->addFlash('success', 'La fiche à été crée');
                return $this->redirectToRoute("mes_fiches");
            }

            return $this->render('fiche/add.html.twig', array('form'=> $form->createView(),'user'=> $user));


    }




    /**
     * @Route("fiches", name="fiches")
     */
public function fiches(){

        $em = $this->getDoctrine()->getManager();
        $fiches = $em->getRepository(Fiche::class)->findAll();
        return $this->render('fiche/fiches.html.twig', compact('fiches'));
}

    /**
     * @Route("fiche/show/{id}", name="fiche_show")
     */
public function show($id, Request $request){

    $em = $this->getDoctrine()->getManager();
    $fiche = $em->getRepository(Fiche::class)->find($id);
    $listeCommentairesFiche = $em->getRepository(Commentaire::class)->findBy(['fiche'=>$fiche], ['created_at'=> 'DESC']);
    $commentaire = new Commentaire();
    $form_comment = $this->createForm(CommentaireType::class,$commentaire);


    if( $this->getUser()){
    $user = $this->getUser();
    $user_comment = $em->getRepository(User::class)->find($user);
    $commentaire->setCreatedAt(new DateTime('now',new \DateTimeZone('Europe/Paris')));
    $commentaire->setFiche($fiche);
   $commentaire->setUser($user_comment);
  // dd($commentaire);
    $form_comment->handleRequest($request);

   // dd($listeCommentairesFiche);
    if($form_comment->isSubmitted() && $form_comment->isValid()){

        $em->persist($commentaire);
        $em->flush();
        $this->addFlash('success', 'Votre commentaire est publié ');
        return $this->redirectToRoute('fiche_show',['id'=>$id]);
     }
    }

    return $this->render('fiche/show.html.twig',array('fiche'=> $fiche, 'form_comment'=> $form_comment->createView(), 'listeCommentairesFiche'=>$listeCommentairesFiche));
}


    /**
     * @Route("my/fiche/show/{id}", name="my_fiche_show")
     */
    public function myShow($id){

//        dd($user);
  $em = $this->getDoctrine()->getManager();
  $fiche = $em->getRepository(Fiche::class)->find($id);

        $listeCommentairesFiche = $em->getRepository(Commentaire::class)->findBy(['fiche'=>$fiche], ['created_at'=> 'DESC']);

  return $this->render('fiche/myShow.html.twig',compact('fiche', 'listeCommentairesFiche'));
    }



    /**
     * @Route("my/fiche/edit/{id}", name="my_fiche_edit")
     */
    public function editMyFicheAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
       $fiche =  $em->getRepository(Fiche::class)->find($id);

        $form = $this->createForm( FicheType::class, $fiche);
        $form->handleRequest($request);
       // dd($form);


            if($form->isSubmitted() and $form->isValid()){
            $em->persist($fiche);
            $em->flush();
            $this->addFlash("notice", "Le fiche à été modifié");
           return $this->redirectToRoute('my_fiche_show', array('id'=>$id));

            }


        return $this->render('fiche/editMyfiche.html.twig', array('form'=> $form->createView()));

}

    /**
     * @Route("my/fiche/delete/{id}", name="my_fiche_delete")
     */
    public function delete($id){
        $em = $this->getDoctrine()->getManager();
        $fiche = $em->getRepository(Fiche::class)->find($id);
        if(!$fiche){
            throw new NotFoundHttpException("L'id n°". $fiche->getId()."n'existe pas");
        }


        $em->remove($fiche);
        $em->flush();
        $this->addFlash("error", "Le fiche à été supprimé");
        return $this->redirectToRoute('mes_fiches');

    }


    /**
     * @Route("my/fiche/confirmation_delete/{id}", name="my_fiche_confirmation_delete")
     */
    public function deletePage($id){
        $em = $this->getDoctrine()->getManager();
        $fiche = $em->getRepository(Fiche::class)->find($id);
        return $this->render('fiche/delete_fiche.html.twig', compact('fiche'));
    }


    /**
     * @Route("fiche/pdf", name="generate_pdf")
     */
    public function generatePdfFiche(Pdf $knpSnappyPdf){
    //    dd($knpSnappyPdf);

        $prenom = "Aladi";
        $nom = "TIMERA";
        $html =  $this->renderView('fiche/fiche_pdf.html.twig', ['nom' => $nom, 'prenom'=> $prenom]);
      return new PdfResponse(
          $knpSnappyPdf->getOutputFromHtml($html),
          'file.pdf',
          'application/pdf',
          'attachment',
          200,
      );
    }
}


