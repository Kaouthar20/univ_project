<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Entity\Etudiant;
use App\Entity\Professeur;
use App\Repository\NoteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NoteController extends AbstractController
{

    /**
     * @Route("/saveNote", name="note_liste") 
     */

    public function saveRelationEN(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $etudiant = new Etudiant();
        for ($i = 1; $i <= 10; $i++) {

            $etudiant->setNom('Computer Peripherals');
            $etudiant->setCne(1111111);
            $etudiant->setTelephone(222222222);
            $etudiant->setEmail('email');
            $entityManager->persist($etudiant);
        }
        $entityManager->flush();
        //profs
        $professeur = new Professeur();

        $professeur->setNom('Computer Peripherals');
        $professeur->setCin(1111111);
        $professeur->setTelephone(222222222);
        $professeur->setEmail('email');
        $entityManager->persist($professeur);
        $entityManager->flush();
        //notes 
        $jour = new \dateTime();
        $note = new Note();
        $note->setNote(19.00);
        $note->setJour($jour);
        $note->setObservation('Ergonomic and stylish!');
        // relates this Nnote to the etudiant
        $note->setEtudiant($etudiant);
        $note->setProfesseur($professeur);
        $entityManager->persist($note);
        //$note->merge($note);
        $entityManager->flush();

        return $this->render(
            'showNote.html.twig',
            ["notes" => $note]
        );
    }


    /**
     * @Route("/notes", name="notes_liste") 
     */

    public function showNote(NoteRepository $noteRepository)
    {

        $notes = $noteRepository->findAll();

        return $this->render(
            'showNote.html.twig',
            ["notes" => $notes]
        );
    }
    /**
     * @Route("add/note", name="add_note")
     */
    public function newNote(ManagerRegistry $doctrine, Request $request)
    {

        $note = new Note();
        $note->setJour(new \DateTime('now'));



        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $doctrine->getManager();
            $entityManager->persist($note);
            $entityManager->flush();
            return $this->redirectToRoute('notes_liste');
        }

        return $this->renderForm('addNote.html.twig', [
            'form' => $form,
        ]);
    }
    /**
     * @Route("/note/etudiant/{etudiant}", name="add_note_to_etudiant")
     */
    public function addNoteToEtudiant(ManagerRegistry $doctrine, Request $request, Etudiant $etudiant)
    {

        $note = new Note();
        $note->setJour(new \DateTime('now'));



        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $note = $form->getData();
            // dd($etudiant);
            $note->setEtudiant($etudiant); //la logique d'ajouter le champ
            // dd($note);
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $doctrine->getManager();
            $entityManager->persist($note);
            $entityManager->flush();
            return $this->redirectToRoute('notes_liste');
        }

        return $this->renderForm('addNote.html.twig', [
            'form' => $form,
        ]);
    }
}
