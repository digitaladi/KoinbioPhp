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

        return $this->render('index/access_admin.html.twig');

    }

    /**
     * @Route("/user/rubriques", name="user_rubriques")
     */
    public function AccessRubriqueUser(){

        return $this->render('index/rubriques.html.twig');

    }

}
