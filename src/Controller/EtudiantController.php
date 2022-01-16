<?php

namespace App\Controller;


use App\Entity\Etudiant;
use Symfony\Component\HttpFoundation\Response;

use App\Repository\EtudiantRepository;
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
}
