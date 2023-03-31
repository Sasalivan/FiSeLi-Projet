<?php

namespace App\DataFixtures;

use App\Entity\GenreSerie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GenreSerieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $genreSerie1 = new GenreSerie();
        $genreSerie1->setNomGenre("Action");
        $manager->persist($genreSerie1);

        $genreSerie2 = new GenreSerie();
        $genreSerie2->setNomGenre("Aventure");
        $manager->persist($genreSerie2);

        $genreSerie3 = new GenreSerie();
        $genreSerie3->setNomGenre("Drame");
        $manager->persist($genreSerie3);

        $genreSerie4 = new GenreSerie();
        $genreSerie4->setNomGenre("Comédie");
        $manager->persist($genreSerie4);

        $genreSerie5 = new GenreSerie();
        $genreSerie5->setNomGenre("Fantastique");
        $manager->persist($genreSerie5);

        $genreSerie6 = new GenreSerie();
        $genreSerie6->setNomGenre("Horreur");
        $manager->persist($genreSerie6);

        $genreSerie7 = new GenreSerie();
        $genreSerie7->setNomGenre("Historique");
        $manager->persist($genreSerie7);

        $genreSerie8 = new GenreSerie();
        $genreSerie8->setNomGenre("Science-Fiction");
        $manager->persist($genreSerie8);

        $genreSerie9 = new GenreSerie();
        $genreSerie9->setNomGenre("Policier");
        $manager->persist($genreSerie9);

        $genreSerie10 = new GenreSerie();
        $genreSerie10->setNomGenre("Romance");
        $manager->persist($genreSerie10);

        $manager->flush();
    }
}
