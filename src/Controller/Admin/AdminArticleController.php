<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleController extends AbstractController
{
    /**
     * @Route("/admin/article/index", name="admin_article_index")
     */
    public function index()
    {

        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();
        return $this->render('admin/article/index.html.twig', [
            'articles' => $articles,
        ]);
    }


    /**
     * @Route("/admin/article/add", name="admin_article_add")
     */
    public function add(Request $request){

        $em = $this->getDoctrine()->getManager();
        $article = new Article();
        $article->setCreatedAt(new \DateTime());
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($article);
            $em->flush();
            $this->addFlash('success', "L'article a été crée");
            return $this->redirectToRoute("admin_article_index");
        }

        return $this->render("admin/article/add.html.twig", array('form' => $form->createView()));

    }


    /**
     * @Route("/admin/article/delete/{id}", name="admin_article_delete")
     */
    public function delete(Article $article){
        $em = $this->getDoctrine()->getManager();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($article);

        if(! $article){
            throw new NotFoundHttpException("L'article n'existe pas");
        }

        $em->remove($article);
        $em->flush();
        $this->addFlash("error", "article supprimé");
        return $this->redirectToRoute("admin_article_index");


    }


    /**
     * @Route("/admin/article/edit/{id}", name="admin_article_edit")
     */
    public function edit(Request $request, Article $article){
        $em = $this->getDoctrine()->getManager();
        $article = $this->getDoctrine()->getRepository(Article::class)->find($article);
        $form_edit = $this->createForm(ArticleType::class, $article);
        $form_edit->handleRequest($request);
        if(!$article){
            throw new NotFoundHttpException("L'article n'existe pas");
        }
        if($form_edit->isSubmitted() && $form_edit->isValid()){
            $em->persist($article);
            $em->flush();
            $this->addFlash("notice", "article édité");
            return $this->redirectToRoute("admin_article_index");

        }

        return $this->render("admin/article/edit.html.twig", array('form_edit'=> $form_edit->createView()));



    }



    /**
     * @Route("/admin/article/show/{id}", name="admin_article_show")
     */
    public function show(Article $article){
$article = $this->getDoctrine()->getRepository(Article::class)->find($article);

        if(!$article){
            throw new NotFoundHttpException("L'article n'existe pas");
        }

        return $this->render("admin/article/show.html.twig", array("article" => $article));

    }







}
