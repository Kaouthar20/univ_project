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
            $etudiant->setNom("nom etudiant :" . $i);
            $etudiant->setCne($i);
            $etudiant->setTelephone($i);
            $etudiant->setEmail("email etudiant: " . $i);

            $manager->persist($etudiant);
        }


        $manager->flush();
        $date = new \DateTime();
        for ($i = 1; $i <= 10; $i++) {
            $notes = new Note();
            $notes->setNote(mt_rand(10, 100));
            $notes->setJour($date);
            $notes->setObservation('excellente Travail ' . $i);
            $notes->setEtudiant($etudiant);
            $manager->persist($notes);
        }
        $manager->flush();
    }
}
