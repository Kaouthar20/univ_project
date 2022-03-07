<?php

namespace App\Controller;


use App\Entity\Etudiant;
use App\Form\EtudiantType;

use App\Repository\EtudiantRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class EtudiantController extends AbstractController
{

    /**
     * @Route("/", name="myApp")
     */
    public function index()
    {


        return $this->render(
            'dashboard.html.twig'
        );
    }

    //geting etudiant data from database
    /**
     * @Route("/etudiant", name="etudiant_liste") 
     */
    public function etuduantListe(EtudiantRepository $etudiantRepository)
    {
        $etudiants = $etudiantRepository->findAll();
        return $this->render(
            'etudiantListe.html.twig',
            ["etudiants" => $etudiants]
        );
    }

    //geting etudiant data by id des from database

    /**
     * @Route("/etudiant/{id}", name="etudiant_show")
     */
    public function show($id, EtudiantRepository $etudiantRepository, Etudiant $etudiant)
    {
        $etudiant = $etudiantRepository->find($id);
        // dd($etudiant);
        return $this->render(
            'show.html.twig',
            ["etudiant" => $etudiant]
        );
    }


    // /**
    //  * @Route("/etudiant/detail/{id}", name="detail_etudiant")
    //  */
    // public function detailEtudiant($id, EtudiantRepository $etudiantRepository, Etudiant $etudiant)
    // {
    //     $etudiant = $etudiantRepository->find($id);
    //     // dd($etudiant);
    //     return $this->render(
    //         'detailEtudiant.html.twig',
    //         ["etudiant" => $etudiant]
    //     );
    // }

    //ajouter etudiant
    /**
     * @Route("add/etudiant", name="add_etudiant")
     */
    public function newEtudiant(ManagerRegistry $doctrine, Request $request, FlashBagInterface $flashMessage)
    {
        $etudiant = new Etudiant();

        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etudiant = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $doctrine->getManager();
            $entityManager->persist($etudiant);
            $entityManager->flush();
            $flashMessage->add("success", "note ajoutée");
            return $this->redirectToRoute('etudiant_liste');
        }

        return $this->renderForm('add.html.twig', [
            'form' => $form,
        ]);
    }

    //editer etudiant
    /**
     * @Route("/etudiant/edit/{id}", name="edit_etudiant")
     */
    public function editEtudiant(ManagerRegistry $doctrine, Etudiant $etudiant, Request $request)
    {
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etudiant = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $doctrine->getManager();
            $entityManager->persist($etudiant);
            $entityManager->flush();
            return $this->redirectToRoute('etudiant_liste');
        }

        return $this->renderForm('edit.html.twig', [
            'form' => $form,
        ]);
    }
    //delete etudiant 
    /**
     * @Route("delete/etudiant/{id}", name="delete_etudiant")
     */
    public function deleteEudiant(ManagerRegistry $doctrine, Etudiant $etudiant)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($etudiant);
        $entityManager->flush();
        return $this->redirectToRoute('etudiant_liste');
    }
}
