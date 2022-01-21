<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\Note;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {

            $etudiant = new Etudiant();
            $notes = new Note();
            $etudiant->setNom("nom etudiant :" . $i);
            $etudiant->setCne($i);
            $etudiant->setTelephone($i);
            $etudiant->setEmail("email etudiant: " . $i);
            $etudiant->setNotes["" . $notes];



            $manager->persist($etudiant);
        }


        $manager->flush();
    }
}
