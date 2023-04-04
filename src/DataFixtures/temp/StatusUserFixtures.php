<?php

namespace App\DataFixtures;

use App\Entity\StatusUser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusUserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $status1 = new StatusUser();
        $status1->setNomStatus("En cours");
        $manager->persist($status1);

        $status2 = new StatusUser();
        $status2->setNomStatus("Terminée");
        $manager->persist($status2);

        $status3 = new StatusUser();
        $status3->setNomStatus("A voir");
        $manager->persist($status2);

        $manager->flush();
    }
}
