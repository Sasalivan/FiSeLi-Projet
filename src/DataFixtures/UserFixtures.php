<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
         $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 2 ; $i++){
            $user = new User();
            $user->setEmail ("admin".$i."@administrateur.com");
            $user->setPassword($this->passwordHasher->hashPassword(
                 $user,
                 'lePassword'
             ));
            $user->setPseudo("Admin");
            $manager->persist ($user);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
