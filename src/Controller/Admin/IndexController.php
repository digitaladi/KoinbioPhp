<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
//        $this->denyAccessUnlessGranted('ROLE_USER');
//        var_dump($this->getUser()->getRoles()[0]);
        return $this->render('index/index.html.twig');
    }

}
