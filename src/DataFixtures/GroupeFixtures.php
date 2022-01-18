<?php

namespace App\DataFixtures;


use App\Entity\Groupe;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {

            $groupe = new Groupe();

            $groupe->setNom("nom de groupe :" . $i);


            $manager->persist($groupe);
        }


        $manager->flush();
    }
}
