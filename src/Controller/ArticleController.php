<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/article', name: 'article_', methods: ['GET'])]
class ArticleController extends AbstractController
{
    #[Route('/list', name: 'list', methods:['GET'])]
    public function list(): Response
    {
        return $this->render('pages/article/list.html.twig',[
            'articles' => [
                [
                    'title' => 'Article1',
                    'content' => 'Article1 content',
                ],
                [
                    'title' => 'Article2',
                    'content' => 'Article2 content',
                ]
            ]
        ]);
    }
    #[Route('/create', name: 'create', methods: ['GET'])]
    public function create(): Response
    {
        return $this->render('pages/article/create.html.twig');
    }
}