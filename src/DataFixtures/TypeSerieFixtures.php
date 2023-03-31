<?php

namespace App\DataFixtures;

use App\Entity\TypeSerie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeSerieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $typeSeries1 = new TypeSerie();
        $typeSeries1->setNom("Dessin animee");
        $manager->persist($typeSeries1);

        $typeSeries2 = new TypeSerie();
        $typeSeries2->setNom("Serie TV");
        $manager->persist($typeSeries2);

        $typeSeries3 = new TypeSerie();
        $typeSeries3->setNom("Emission");
        $manager->persist($typeSeries3);

        $typeSeries4 = new TypeSerie();
        $typeSeries4->setNom("Anime");
        $manager->persist($typeSeries4);

        $typeSeries5 = new TypeSerie();
        $typeSeries5->setNom("Serie Documentaire");
        $manager->persist($typeSeries5);

        $manager->flush();
    }
}
