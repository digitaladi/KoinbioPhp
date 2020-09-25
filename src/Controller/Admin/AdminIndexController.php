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

}
