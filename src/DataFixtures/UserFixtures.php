<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $plaintextPassword = '1234';
        $hashedPassword = $this->passwordHasher->hashPassword($user, $plaintextPassword);
        $user->setUsername("kawtar");
        $user->setEmail("kawtar@gmail.com");
        $user->setPassword($hashedPassword);


        $manager->persist($user);

        $manager->flush();
    }
}
