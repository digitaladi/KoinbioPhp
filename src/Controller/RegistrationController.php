<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/profil", name="profil")
     */
    public function index(Request $request)
    {

        return new Response("ok");

    }



    /**
     * @Route("/registration", name="registration")
     */
public function register(Request $request, UserPasswordEncoderInterface $encoder){
    $user = new User();
    $em = $this->getDoctrine()->getManager();
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    var_dump($user->getRoles());
    if($form->isSubmitted() and $form->isValid()){
        $password = $encoder->encodePassword($user, $user->getPassword()) ;
        $user->setPassword($password);

        $em->persist($user);
        $em->flush();

        $this->addFlash('success','Utilisateur enregistré');
        return $this->redirectToRoute('index');
    }


    return $this->render('registration/index.html.twig', [
        "form" => $form->createView()
    ]);
}


}