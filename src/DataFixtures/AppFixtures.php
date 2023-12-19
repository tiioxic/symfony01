<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hash;
    public function __construct(UserPasswordHasherInterface $pwd)
    {
        $this->hash = $pwd;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i=1; $i<10;$i++){
        $user = new User();
        $user->setPrenom("Bart");
        $user->setNom("Simpson");
        $user->setEmail("bart_$i@test.fr");

        $password = $this->hash->hashPassword($user, "test123");
        $user->setPassword("$password");


        $manager->persist($user);
        }
        $manager->flush();
    }
}
