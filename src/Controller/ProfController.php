<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Repository\ProfesseurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class ProfController extends AbstractController
{

    /**
     * @Route("/prof", name="profs_liste") 
     */

    public function showProf(ProfesseurRepository $professeurRepository)
    {

        $professeurs = $professeurRepository->findAll();

        return $this->render(
            'showProf.html.twig',
            ["professeurs" => $professeurs]
        );
    }


    /**
     * @Route("/prof/{id}", name="groupeEncadrerPar")
     */
    public function showEncadrerGroupe($id, ProfesseurRepository $professeurRepository, Professeur $professeur)
    {


        // foreach ($etudiant->getNotes() as $note) {
        //     dump($note);
        // }



        $professeurs = $professeurRepository->find($id);
        // dd($etudiant);
        return $this->render(
            'encadrerPar.html.twig',
            ["professeurs" => $professeurs]
        );
    }

    /**
     * @Route("add/professeur", name="add_professeur")
     */
    public function newProfesseur(ManagerRegistry $doctrine, Request $request, FlashBagInterface $flashMessage)
    {
        $professeur = new Professeur();

        $form = $this->createForm(ProfesseurType::class, $professeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $professeur = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $doctrine->getManager();
            $entityManager->persist($professeur);
            $entityManager->flush();
            $flashMessage->add("success", "prof ajoutée");
            return $this->redirectToRoute('profs_liste');
        }

        return $this->renderForm('addProf.html.twig', [
            'form' => $form,
        ]);
    }
}
