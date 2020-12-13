<?php

namespace App\Controller\Others;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function index()
    {

        $articles_actifs = $this->getDoctrine()->getRepository(Article::class)->getArticlesActif();
        return $this->render('article/index.html.twig', [
            'articles_actifs' => $articles_actifs,
        ]);
    }

    /**
     * @Route("/article/{id}", name="article")
     */
    public function show(Article $article){
    $article = $this->getDoctrine()->getRepository(Article::class)->find($article);
    if(!$article){
     throw new NotFoundHttpException("L'article n'existe pas");
    }
    return $this->render('article/show.html.twig', array('article' => $article));
    }
}
/*coranavirus*/