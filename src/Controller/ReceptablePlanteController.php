<?php

namespace App\Controller;

use App\Entity\ReceptablePlante;

use App\Form\ReceptablePlanteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReceptablePlanteController extends AbstractController
{
    /**
     * @Route("/receptable/plante/index", name="receptable_plante_index")
     */
    public function index()
    {
       $receptables =  $this->getDoctrine()->getRepository(ReceptablePlante::class)->findAll();
        return $this->render('admin/receptable_plante/index.html.twig', [
            'receptables' => $receptables,
        ]);
    }

    /**
     * @Route("/admin/receptable/add", name="admin_receptable_add")
     */
    public function add(Request $request){

        $receptablePlante = new ReceptablePlante();
         $form = $this->createForm(ReceptablePlanteType::class, $receptablePlante);
         $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $em->persist($receptablePlante);
            $em->flush();
            $this->addFlash("success", "Le receptable de plante a été ajouté");
            return  $this->redirectToRoute('receptable_plante_index');

        }

        return $this->render('admin/receptable_plante/add.html.twig', array('form'=> $form->createView()));
    }


    /**
     * @Route("/admin/receptable/show/{id}", name="admin_receptable_show")
     */
    public  function show(ReceptablePlante $receptablePlante){

        $receptablePlante = $this->getDoctrine()->getRepository(ReceptablePlante::class)->find($receptablePlante);

        if(! $receptablePlante){
            throw $this->createNotFoundException("L'id n°". $receptablePlante->getId()."n'existe pas");
        }

        return $this->render('admin/receptable_plante/show.html.twig', array('receptable'=> $receptablePlante));
    }


    /**
     * @Route("/admin/receptable/edit/{id}", name="admin_receptable_edit")
     */
    public function edit(Request $request, ReceptablePlante $receptablePlante){

        $em = $this->getDoctrine()->getManager();
        $form_edit = $this->createForm(ReceptablePlanteType::class, $receptablePlante);
        $form_edit->handleRequest($request);
        if($form_edit->isSubmitted() && $form_edit->isValid()){

            $em->persist($receptablePlante);
            $em->flush();
            $this->addFlash('success', "Le receptable à eté édité");
            return $this->redirectToRoute('receptable_plante_index');
        }

        return $this->render('admin/receptable_plante/edit.html.twig', array('form_edit'=> $form_edit->createView()));

    }

    /**
     * @Route("/admin/receptable/delete/{id}", name="admin_receptable_delete")
     */
    public function delete(ReceptablePlante $receptablePlante){

        $em =$this->getDoctrine()->getManager();
        $receptablePlante =  $this->getDoctrine()->getRepository(ReceptablePlante::class)->find($receptablePlante);

            $em->remove($receptablePlante);
            $em->flush();
            $this->addFlash('error', 'Le receptable a été supprimé');
          return  $this->redirectToRoute('receptable_plante_index');


    }


}
