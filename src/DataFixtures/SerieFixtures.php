<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Serie;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\GenreSerieFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SerieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i=0;$i<10; $i++){

            $serie = new Serie();
            $serie->setTitre($faker->lastName);
            $serie->setEpisode(rand(1,20));
            $serie->setDureeEp(rand(40,90));
            $serie->setDateSortie(rand(1990,2030));
            $serie->setStatus("terminée");
            
            $manager->persist($serie);
        }


        $manager->flush();
    }


    public function getDependencies()
    {
        return ([
            TypeSerieFixtures::class,
            GenreSerieFixtures::class, // 'App\DataFixtures\AeroportFixtures'
            // autre classe ici 
        ]);
    }
}
