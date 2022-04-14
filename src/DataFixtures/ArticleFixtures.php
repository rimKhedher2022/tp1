<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1 ; $i<=10; $i++)
        {
            $article = new Article();
            $article->setTitle("Ici un article avec  n .$i")
                     ->setContent("<p>contenu de l'article n .$i </p>")
                     ->setImage("http://via.placeholder.com/350x150")
                     ->setCreatedAt(new \DateTimeImmutable());

                     $manager->persist($article);

        }
        $manager->flush();
    }
}
