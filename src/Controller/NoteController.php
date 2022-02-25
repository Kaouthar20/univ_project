<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\User;
use App\Entity\Groupe;
use App\Form\NoteType;
use App\Entity\Etudiant;
use App\Entity\Professeur;
use App\Repository\NoteRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\Cast\Double;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class NoteController extends AbstractController
{

    /**
     * @Route("/saveNote", name="note_liste") 
     */

    // public function saveRelationEN(ManagerRegistry $doctrine): Response
    // {
    //     $entityManager = $doctrine->getManager();
    //     $etudiant = new Etudiant();


    //     $etudiant->setNom('Computer Peripherals');
    //     $etudiant->setCne(1111111);
    //     $etudiant->setTelephone(222222222);
    //     $etudiant->setEmail('email');
    //     $entityManager->persist($etudiant);

    //     $entityManager->flush();
    //     //profs
    //     $professeur = new Professeur();

    //     $professeur->setNom('Computer Peripherals');
    //     $professeur->setCin(1111111);
    //     $professeur->setTelephone(222222222);
    //     $professeur->setEmail('email');
    //     $entityManager->persist($professeur);
    //     $entityManager->flush();
    //     //notes 
    //     $jour = new \dateTime();
    //     $note = new Note();
    //     $note->setNote(19.00);
    //     $note->setJour($jour);
    //     $note->setObservation('Ergonomic and stylish!');
    //     // relates this Nnote to the etudiant
    //     $note->setEtudiant($etudiant);
    //     $note->setProfesseur($professeur);
    //     $entityManager->persist($note);
    //     //$note->merge($note);
    //     $entityManager->flush();

    //     return $this->render(
    //         'showNote.html.twig',
    //         ["notes" => $note]
    //     );
    // }


    /**
     * @Route("/notes", name="notes_liste") 
     */

    public function showNote(NoteRepository $noteRepository)
    {
        $notes = $noteRepository->findAll();

        // return $this->redirectToRoute('login');

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
     * @Route("/note/etudiant", name="add_note_to_etudiant")
     */
    public function addNoteToEtudiant(ManagerRegistry $doctrine, Request $request)
    {

        // $note = new Note();
        // $note->setJour(new \DateTime('now'));

        //Get data from modal in twig findEtudiantListe

        $idEtudiant = $request->get('idEt');
        $note  = (float) $request->get('note');
        $observation = $request->get('observation');
        $idProf = $request->get('idProf');

        $fnote = (float) $note;
        // dd(gettype($note));
        //Find etudiant and prof by id

        $prof = $doctrine->getRepository(Professeur::class)->find($idProf);
        $etudiant = $doctrine->getRepository(Etudiant::class)->find($idEtudiant);

        //Add new note

        $note = new Note();

        $note->setEtudiant($etudiant)
            ->setNote($fnote)
            ->setObservation($observation)
            ->setProfesseur($prof)
            ->setJour(new \DateTime());

        $em = $doctrine->getManager();

        $em->persist($note);
        $em->flush();




        return new JsonResponse('OK');


        // $form = $this->createForm(NoteType::class, $note);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $note = $form->getData();
        //     // dd($etudiant);
        //     $note->setEtudiant($etudiant); //la logique d'ajouter le champ
        //     // dd($note);
        //     // ... perform some action, such as saving the task to the database
        //     // for example, if Task is a Doctrine entity, save it!
        //     $entityManager = $doctrine->getManager();
        //     $entityManager->persist($note);
        //     $entityManager->flush();
        //     return $this->redirectToRoute('notes_liste', ['id' => $note->getId()]);
        // }

        // return $this->renderForm('addNote.html.twig', [
        //     // 'formNote' => $form,
        // ]);
    }

    /**
     * @Route("/test", name="testData")
     */
    public function testData(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        for ($i = 1; $i <= 6; $i++) {
            $groupe = new Groupe();

            $groupe->setNom("groupe :" . $i);
            $entityManager->persist($groupe);
            $entityManager->flush();
            // $user = new User();

            // $user->setUsername("username:" . $i);
            // $user->setEmail("email:" . $i);
            // $user->setPassword("password:" . $i);
            //  $user->setRoles(array $roles);


            $professeur = new Professeur();
            $professeur->setNom("nom professeur :" . $i);
            $professeur->setCin($i);
            $professeur->setTelephone($i);
            $professeur->setEmail("email professeur: " . $i);
            // $professeur->setUser($this->getUser());
            // // $professeur->setUser($entityManager->getRepository(User::class)->find(38));
            $etudiant = new Etudiant();
            $professeur->addGroupe($groupe);
            $etudiant->setNom("nom etudiant  :" . $i);
            $etudiant->setCne($i);

            $etudiant->setTelephone($i);
            $etudiant->setEmail("email etudiant:" . $i);
            $etudiant->setGroupe($groupe);
            $entityManager->persist($etudiant);

            $entityManager->persist($professeur);
            $entityManager->flush();
        }



        $date = new \DateTime();

        $notes = new Note();
        $notes->setNote(mt_rand(10, 20));
        $notes->setJour($date);
        $notes->setObservation('excellente');
        $notes->setProfesseur($professeur);
        $notes->setEtudiant($etudiant);
        $entityManager->persist($notes);

        $entityManager->flush();

        die('good');
        // return new Response(
        //     'Saved new etudiant with id: ' . $etudiant->getId()
        //         . ' and new professeur with id: ' . $professeur->getId()
        //         . ' and new groupe with id: ' . $groupe->getId()
        // );
    }
}
