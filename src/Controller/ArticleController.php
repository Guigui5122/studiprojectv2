<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Article;


#[Route('/article', name: 'article_')]
class ArticleController extends AbstractController
{
    #[Route('/list', name: 'list', methods:['GET'])]
    public function list(EntityManagerInterface $em): Response
    {
        $articles = $em->getRepository(Article::class)->findAll();

        return $this->render('pages/article/list.html.twig',[
            'articles' => $articles
        ]);
    }
    #[Route('/create', name: 'create', methods: ['GET'])]
    public function create(): Response
    {
        return $this->render('pages/article/create.html.twig');
    }
}