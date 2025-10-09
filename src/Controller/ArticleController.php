<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ArticleType;
use App\Entity\Article;
use App\Service\Form\FormHandler;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

#[Route('/article', name: 'article_')]
class ArticleController extends AbstractController
{
    #[Route('/list', name: 'list', methods: ['GET'])]
    public function list(EntityManagerInterface $em): Response
    {
        $articles = $em->getRepository(Article::class)->findAll();

        return $this->render('pages/article/list.html.twig', [
            'articles' => $articles
        ]);
    }


    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    public function create(FormHandler $formHandler): Response
    {
        return $formHandler->handle(ArticleType::class, $this->generateUrl('article_list'), 'pages/article/create.html.twig');

        //* CODE AVANT REGROUPEMENT DANS LE SERVICE 'FORMHANDLER' :
        // $form = $this->createForm(ArticleType::class);
        // $form->add('submit', SubmitType::class);

        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $article = $form->getData();

        //     $em->persist($article);
        //     $em->flush();

        //     return $this->redirectToRoute('article_list');
        // }

        // return $this->render('pages/article/create.html.twig', [
        //     'form' => $form->createView(),

        // ]);
    }

     #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(FormHandler $formHandler, Article $article): Response
    {
        return $formHandler->handle(ArticleType::class, $this->generateUrl('article_list'), 'pages/article/edit.html.twig', $article);
    }
   
        
        //* CODE AVANT REGROUPEMENT DANS LE SERVICE 'FORMHANDLER' :
        // $form = $this->createForm(ArticleType::class, $article);

        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $article = $form->getData();

        //     $em->persist($article);
        //     $em->flush();

        //     return $this->redirectToRoute('article_list');
        // }

        // return $this->render('pages/article/edit.html.twig', [
        //     'form' => $form->createView(),
        //     'form_errors' =>$form->getErrors(),
        //     'article' => $article,

        // ]);
    }

