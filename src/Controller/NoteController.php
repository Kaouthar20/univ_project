<?php

namespace App\Controller;


use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NoteController extends AbstractController
{

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
}
