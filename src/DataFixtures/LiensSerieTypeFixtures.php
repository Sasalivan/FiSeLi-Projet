<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Serie;
use App\Entity\TypeSerie;
use App\DataFixtures\SerieFixtures;
use App\DataFixtures\TypeSerieFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LiensSerieTypeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        // on obtient tous les types. Pour chaque Evenement on fixera un User random
        $rep = $manager->getRepository(TypeSerie::class);
        $types = $rep->findAll();

        $rep = $manager->getRepository(Serie::class);
        $series = $rep->findAll();

        for ($i = 0; $i < count($series); $i++) {
            // affecter un type random et un produit random
            $typeChoisie = $types[rand(0, count($types) - 1)];
            $series[$i]->setTypeSerie($typeChoisie);
            

            $manager->persist($series[$i]);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return ([
            SerieFixtures::class,
            TypeSerieFixtures::class
        ]);
    }
}