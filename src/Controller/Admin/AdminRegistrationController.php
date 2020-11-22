<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserEditType;
use App\Form\UserType;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminRegistrationController extends AbstractController
{



    /**
     * @Route("admin/users", name="admin_index_user")
     *
     *
     */
    public function index(TokenStorageInterface $storage){
//        var_dump($storage->getToken()->getUser());


        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findAll();

        return $this->render('security/admin/index.html.twig', [ 'users' => $users ]);

    }






    /**
     * @Route("/admin/register/user", name="security_admin_register")
     */

    public function register(Request $request, UserPasswordEncoderInterface $encoder){

        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('index');
        }
        $user = new User();
//        dd($user);
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

//    var_dump($user->getRoles());
        if($form->isSubmitted() && $form->isValid()){
            $password = $encoder->encodePassword($user, $user->getPassword()) ;
            $user->setPassword($password);

            $em->persist($user);
            $em->flush();

            $this->addFlash("success","Utilisateur enregistré");
            return $this->redirectToRoute('admin_index_user');
        }



        return $this->render('security/admin/register.html.twig', [
            "form" => $form->createView()
        ]);
    }





    /**
     * @param $id
     * @Route("/admin/delete/user/{id}", name="admin_delete_user")
     */
    public function delete($id)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('index');
        }

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $em->remove($user);
        $em->flush();
        $this->addFlash('notice', "l'utilisateur est supprimé");
        return $this->redirectToRoute('admin_index_user');
    }



    /**
     * @param $id
     * @Route("/admin/show/user/{id}", name="admin_show_user")
     */
    public function show($id){

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('index');
        }

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        return $this->render('security/admin/show.html.twig', ['user' => $user]);
    }






    /**
     * @Route("/admin/edit/user/{id}", name="admin_edit_user")
     */
    public function edit($id, Request $request){

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('index');
        }

        $em = $this->getDoctrine()->getManager();
        $user =  $em->getRepository(User::class)->find($id);
        if($user){
            $editUserForm = $this->createForm(UserEditType::class, $user);
            $editUserForm->handleRequest($request);
            if($editUserForm->isSubmitted() && $editUserForm->isValid()){
                $em->persist($user);
                $em->flush();
                $this->addFlash('notice','Utilisateur modifié');

            }
        }else{
            throw $this->createNotFoundException(" $id n'existe pas");
        }
//        dump($user);
//        die('ok');


        return $this->render('security/admin/edit.html.twig', ['edit_form_user' => $editUserForm->createView()]);

    }




}

