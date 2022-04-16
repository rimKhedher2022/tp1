<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]

    public function index(ArticleRepository $repo): Response
    {
        $articles = $repo->findAll('Titre de l\'article');// trouver les articles
         
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



    
    #[Route('/blog/new', name: 'blog_create')]
    #[Route('/blog/{id}/edit', name: 'blog_edit')]
    public function form( Article $article =null ,Request $request , EntityManagerInterface $manager)
    {
      if (!$article)
      {$article = new Article(); }
         

   

         $form = $this->createFormBuilder($article)
                        ->add('title')
                        ->add('content')
                        ->add('image')

                        ->add('save',SubmitType::class,[
                            'label'=> 'Enregister'
                        ])
                        ->getForm();
                        $form->handleRequest($request);
                       // dump($article);



                       if($form->isSubmitted()&& $form->isValid())

                       {

                        if (!$article->getId())
                        {
                            $article->setCreatedAt(new \DateTimeImmutable());
                        }

                        
                        $manager->persist($article);
                        $manager->flush();
                        return $this->redirectToRoute('blog_show',['id' =>$article->getId()]);
                       }


        return $this->render('blog/create.html.twig',
        ['formArticle' =>$form->createView()]
    
    );
     }


    #[Route('/blog/{id}', name: 'blog_show')]
    public function show($id,ManagerRegistry $doctrine , ArticleRepository $repo)

    {
      
         $article = $repo->find($id); 
        return $this->render('blog/show.html.twig',['article'=>$article]);
        
        
     }


}
