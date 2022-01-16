<?php

namespace App\Controller;


use App\Entity\Etudiant;
use App\Form\EtudiantType;

use App\Repository\EtudiantRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/", name="etudiant_liste") 
     */

    public function index(EtudiantRepository $etudiantRepository)
    {

        $etudiants = $etudiantRepository->findAll();

        return $this->render(
            'home.html.twig',
            ["etudiants" => $etudiants]
        );
    }

    /**
     * @Route("/etudiant/{id}", name="etudiant_show")
     */
    public function show($id, EtudiantRepository $etudiantRepository)
    {
        $etudiant = $etudiantRepository->find($id);
        // dd($etudiant);
        return $this->render(
            'show.html.twig',
            ["etudiant" => $etudiant]
        );
    }
    /**
     * @Route("add/etudiant", name="add_etudiant")
     */
    public function newEtudiant(Request $request)
    {
        $etudiant = new Etudiant();

        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etudiant = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($etudiant);
            $entityManager->flush();
            return $this->redirectToRoute('etudiant_liste');
        }

        return $this->renderForm('add.html.twig', [
            'form' => $form,
        ]);
    }
}
