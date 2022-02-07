<?php

namespace App\DataFixtures;

use App\Entity\Note;
use App\Entity\Groupe;
use App\Entity\Etudiant;
use App\Entity\Professeur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpFoundation\Response;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // for ($i = 1; $i <= 10; $i++) {
        $groupe = new Groupe();
        $groupe->setNom("nom de groupe :");
        $manager->persist($groupe);
        // }
        $manager->flush();

        // for ($i = 1; $i <= 10; $i++) {
        $professeur = new Professeur();
        $professeur->setNom("nom professeur :");
        $professeur->setCin(21356477);
        $professeur->setTelephone(65987452);
        $professeur->setEmail("email professeur: ");
        $professeur->addGroupe($groupe);
        $manager->persist($professeur);
        // }
        $manager->flush();

        // for ($i = 1; $i <= 10; $i++) {
        $etudiant = new Etudiant();
        $etudiant->setNom("nom etudiant :");
        $etudiant->setCne(2222);
        $etudiant->setTelephone(25613594);
        $etudiant->setEmail("email etudiant: ");
        $etudiant->setGroupe($groupe);
        $manager->persist($etudiant);
        // }
        $manager->flush();

        $date = new \DateTime();
        // for ($i = 1; $i <= 10; $i++) {
        $notes = new Note();
        // $professeur = new Professeur();

        $notes->setNote(mt_rand(10, 100));
        $notes->setJour($date);
        $notes->setObservation('excellente Travail ');
        $notes->setProfesseur($professeur);
        $notes->setEtudiant($etudiant);
        $manager->persist($notes);
        // }
        $manager->flush();
    }
}
