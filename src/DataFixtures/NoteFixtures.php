<?php

namespace App\DataFixtures;

use App\Entity\Note;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class NoteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $note = new Note();
            $date = new \DateTime();
            $note->setNote(mt_rand(10, 100));
            $note->setJour($date);
            $note->getObservation('excellente Travail ' . $i);

            $manager->persist($note);
        }

        $manager->flush();
    }
}
