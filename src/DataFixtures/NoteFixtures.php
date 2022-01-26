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
    }
}
