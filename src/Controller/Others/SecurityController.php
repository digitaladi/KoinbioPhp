<?php

namespace App\Controller\Others;

use App\Entity\Fiche;
use App\Entity\User;
use App\Form\UserEditType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
     * @Route("/register", name="Registration_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder){


        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('index');
        }

        $user = new User();
        $user->setRoles(['ROLE_USER']);
//        $date = new \DateTime();
//        $date_day = $date->format('Y-m-d H:i:s');
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());
        $em = $this->getDoctrine()->getManager();
//        $form = $this->createForm(UserType::class, $user);
        $form = $this->createFormBuilder($user)

            ->add('username',TextType::class, ['label' => 'Votre pseudo'])
            ->add('email', EmailType::class, ['label' => 'Votre mail'])
//            ->add('password', PasswordType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'label'=> 'Votre mot de passe',
//                'placeholder'=> 'Votre mot de passe',
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Votre mot de passe'],
                'second_options' => ['label' => 'Confirmer votre mot de passe'],
            ])
//            ->add('postal_code',NumberType::class)
//            ->add('commune', TextType::class)
            ->add('submit', SubmitType::class, ['attr'=> ['class'=>'koin_btn btn'], 'label'=> 'S\'inscrire',])
            ->getForm();
        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()){

            $password = $encoder->encodePassword($user, $user->getPassword()) ;
            $user->setPassword($password);
//            dd($user);
            $em->persist($user);
            $em->flush();

            $this->addFlash('success','Utilisateur enregistré');
            return $this->redirectToRoute('index');
        }


        return $this->render('registration/register.html.twig', [
            "form" => $form->createView()
        ]);
    }


    /**
     *
     * @Route('/compte/{id}', name="compte_user")
     */
//public function show(User $user){
//
//    $user = $this->getDoctrine()->getRepository(User::class)->find($user);
//
//}




    /**
     *
     * @Route("/profil", name="compte_profil")
     */
    public function compte(){

       $user =  $this->getUser();
//        dd($user);
        $nbfiches = $this->getDoctrine()->getRepository(Fiche::class)->getFicheByUser($user);
//        dd(count($Fiches));
//        die("ok");
     return $this->render('security/compte.html.twig', array('user'=>$user, 'nbrfiches'=> $nbfiches));

    }





}
