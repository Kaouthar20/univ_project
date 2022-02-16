<?php

namespace App\DataFixtures;

use App\Entity\Note;
use App\Entity\Groupe;
use App\Entity\Etudiant;
use App\Entity\Professeur;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //     for ($i = 1; $i <= 10; $i++) {
        //         $groupe = new Groupe();
        //         $user = new User();
        //         $groupe->setNom("groupe :" . $i);

        //         $professeur = new Professeur();
        //         $professeur->setNom("nom professeur :" . $i);
        //         $professeur->setCin($i);
        //         $professeur->setTelephone($i);
        //         $professeur->setEmail("email professeur: " . $i);
        //         // $professeur->setUser($user);
        //         $professeur->addGroupe($groupe);




        //         $etudiant = new Etudiant();

        //         $etudiant->setNom("nom etudiant  :" . $i);
        //         $etudiant->setCne($i);

        //         $etudiant->setTelephone($i);
        //         $etudiant->setEmail("email etudiant:" . $i);
        //         $etudiant->setGroupe($groupe);
        //         $manager->persist($groupe);
        //         $manager->persist($etudiant);
        //         $manager->persist($professeur);

        //         $manager->flush();
        //     }



        //     $date = new \DateTime();

        //     $notes = new Note();
        //     $notes->setNote(mt_rand(10, 100));
        //     $notes->setJour($date);
        //     $notes->setObservation('excellente Travail ');
        //     $notes->setProfesseur($professeur);
        //     $notes->setEtudiant($etudiant);
        //     $manager->persist($notes);

        //     $manager->flush();
    }
}
