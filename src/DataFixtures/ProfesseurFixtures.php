<?php

namespace App\DataFixtures;

use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfesseurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {

            $professeur = new Professeur();

            $professeur->setNom("nom professeur :" . $i);
            $professeur->setCin($i);
            $professeur->setTelephone($i);
            $professeur->setEmail("email professeur: " . $i);

            $manager->persist($professeur);
        }


        $manager->flush();
    }
}
