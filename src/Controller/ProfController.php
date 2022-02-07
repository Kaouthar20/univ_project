<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Repository\ProfesseurRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
}
