<?php

namespace App\DataFixtures;

use App\Entity\TypeSerie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeSerieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $typeSeries = new TypeSerie();
        $typeSeries->setNom("Dessin animee");

        $manager->persist($typeSeries);

        $manager->flush();
    }
}
