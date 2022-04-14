<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(ManagerRegistry $doctrine , ArticleRepository $repo): Response
    {

       
        $articles = $repo->findAll('Titre de l\'article');
         
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    #[Route('/', name: 'home')]

    public function home()


    {
        return $this->render('blog/home.html.twig',
        ['title' => "bienvenue ici les amis",
        'age' => 31
        ] );
    
   
    }




    #[Route('/blog/article/12', name: 'blog_show')]
    public function show($id,ManagerRegistry $doctrine , ArticleRepository $repo)

    { $article = $repo->find($id); 
        return $this->render('blog/show.html.twig',['article'=>$article]);
     }
}
