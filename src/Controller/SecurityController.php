<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUserName = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUserName, 'error' => $error
        ]);
    }



    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){

    }



    /**
     * @Route("/admin/register/user", name="security_admin_register")
     */

    public function register(Request $request, UserPasswordEncoderInterface $encoder){
        $user = new User();
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
            return $this->redirectToRoute('login');
        }
        

        return $this->render('security/admin/register.html.twig', [
            "form" => $form->createView()
        ]);
    }



    /**
     * @Route("/admin/edit/user/{id}", name="admin_edit_user")
     */
    public function edit($id, Request $request){

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
     * @param $id
     * @Route("/admin/show/user/{id}", name="admin_show_user")
     */
    public function show($id){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        return $this->render('security/admin/show.html.twig', ['user' => $user]);
    }

    /**
     * @param $id
     * @Route("/admin/delete/user/{id}", name="admin_delete_user")
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        $em->remove($user);
        $em->flush();
        $this->addFlash('notice', "l'utilisateur est supprimé");
        return $this->redirectToRoute('admin_index_user');
    }

}
