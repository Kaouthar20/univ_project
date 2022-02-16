<?php

namespace App\Controller;

use App\Entity\Groupe;
use App\Entity\Etudiant;
use App\Repository\GroupeRepository;
use App\Repository\EtudiantRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupeController extends AbstractController
{

    /**
     * @Route("/groupe", name="groupe_liste") 
     */

    public function showGroupe(GroupeRepository $groupeRepository)
    {

        $groupes = $groupeRepository->findAll();

        return $this->render(
            'showGroupe.html.twig',
            ["groupes" => $groupes]
        );
    }

    /**
     * @Route("/groupe/{id}", name="groupe_show")
     */
    public function findListeEtudiant($id, GroupeRepository $groupeRepository, Groupe $groupe)
    {






        $groupe = $groupeRepository->find($id);
        // dd($etudiant);
        return $this->render(
            'findEtudiantListe.html.twig',
            ["groupe" => $groupe]
        );
    }
    // public function showGroupe(GroupeRepository $groupeRepository)
    // {
    //     // dd($this->getUser()->getProfesseur());
    //     $groupes = $groupeRepository->findGroupesByUser($this->getUser());
    //     // dd($groupes);

    //     return $this->render(
    //         'showGroupe.html.twig',
    //         ["groupes" => $groupes]
    //     );
    // } 

}
