<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\Groupe;
use App\Entity\Note;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpFoundation\Response;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i <= 10; $i++) {
            $groupe = new Groupe();

            $groupe->setNom("nom de groupe :" . $i);
            $manager->persist($groupe);
        }
        $manager->flush();

        for ($i = 1; $i <= 10; $i++) {
            $groupe = new Groupe();
            $etudiant = new Etudiant();
            $etudiant->setNom("nom etudiant :" . $i);
            $etudiant->setCne($i);
            $etudiant->setTelephone($i);
            $etudiant->setEmail("email etudiant: " . $i);
            $etudiant->setGroupe($groupe);
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

        // for ($i = 1; $i <= 10; $i++) {
        //     $groupe = new Groupe();
        //     $groupe->setNom("nom etudiant :" . $i);

        //     $groupe->setEtudiants($etudiants);
        //     $manager->persist($groupe);
        // }
        // $manager->flush();
        // return new Response(
        //     'Saved new product with id: ' . $notes->getId()
        //         . ' and new category with id: ' . $etudiant->getId()
        // );
    }
}
