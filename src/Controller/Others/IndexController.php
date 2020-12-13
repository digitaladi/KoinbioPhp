<?php


namespace App\Controller\Others;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    /**
     * @Route("/infosite", name="info_site")
     */
    public function infoSiteAction(){
        return $this->render('index/info_site.html.twig');
    }


    /**
     * @Route("/mentionslegales", name="mentions_legales")
     */
    public function mentionsLegalesAction(){
        return $this->render('index/mentionsLegales.html.twig');
    }


    /**
     * @Route("/galerie", name="galerie")
     */
    public function galerie(){

        return $this->render('index/galerie.html.twig');

    }

    /**
     * @Route("/statistiques", name="statistiques")
     */
    public function statistiques(){

        return $this->render('index/statistiques.html.twig');

    }

    /**
     * @Route("/score", name="score")
     */
    public function score(){

        return $this->render('index/score.html.twig');

    }



}