<?php

namespace App\Controller;


use App\Repository\NoteRepository;
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
}
