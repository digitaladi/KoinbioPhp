<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminIndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
//        $this->denyAccessUnlessGranted('ROLE_USER');
//        var_dump($this->getUser()->getRoles()[0]);

//        dump( new Response());
        return $this->render('index/index.html.twig');
    }


    /**
     * @Route("/access/admin", name="access_admin")
     */
    public function AccessDashboardAdmin(){

        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('index');
        }
        return $this->render('index/access_admin.html.twig');

    }

    /**
     * @Route("/user/rubriques", name="user_rubriques")
     */
    public function AccessRubriqueUser(){
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('index');
        }
        return $this->render('index/rubriques.html.twig');

    }

}
