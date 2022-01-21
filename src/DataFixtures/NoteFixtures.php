<?php

namespace App\DataFixtures;

use App\Entity\Note;
use App\Entity\Etudiant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class NoteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $etudiant = new Etudiant();
            $notes = new Note();
            $date = new \DateTime();
            $notes->setNote(mt_rand(10, 100));
            $notes->setJour($date);
            $notes->setObservation('excellente Travail ' . $i);
            $notes->setEtudiant($etudiant);

            $manager->persist($notes);
            $manager->persist($etudiant);
        }

        $manager->flush();
    }
}
