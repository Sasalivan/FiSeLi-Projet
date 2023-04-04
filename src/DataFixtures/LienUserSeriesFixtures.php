<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Serie;
use App\Entity\User;
use App\Entity\StatusSerie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LienUserSeriesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        // on obtient tous les users. Pour chaque Evenement on fixera un User random
        $rep = $manager->getRepository(User::class);
        $users = $rep->findAll();

        $rep = $manager->getRepository(Serie::class);
        $series = $rep->findAll();

        // créer des DetailsUser
        for ($i = 0; $i < count($users); $i++) {

            $userChoisie = $users[$i];

            for ($j = 0; $j < 5; $j++) {
                // affecter un user random et un serie random
                $serieChoisi = $series[$j];
    
                $statusSerie = new StatusSerie();
                $statusSerie->setSerie($serieChoisi);
                $statusSerie->setUser($userChoisie);
                
    
                $statusSerie->setNomStatus("watching");
    
    
                $statusSerie->setNbEpisodeUser(rand(1,10));
                
                
                $userChoisie->addStatus($statusSerie);
                $serieChoisi->addStatus($statusSerie);
    
            }
            $manager->persist($statusSerie);
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return ([
            SerieFixtures::class,
            UserFixtures::class
        ]);
    }
}