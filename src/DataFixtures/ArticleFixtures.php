<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use Faker\Factory;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void


    {

        $faker = \Faker\Factory::create ('FN_tn');
        // créer 3 cat faké
        for ($i=1 ; $i<=3; $i++)

     {
            $category = new Category(); 
            $category->setTitle($faker->sentence())
                    ->setDescription($faker->paragraph());
            $manager->persist($category);


        
          //  $content ='<p>';
          


        
    }


    $manager->flush();
}


}
