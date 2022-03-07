<?php

namespace App\Controller;

use App\Entity\Note;
use App\Entity\Groupe;
use App\Form\NoteType;
use App\Entity\Etudiant;
use App\Entity\Professeur;
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
    public function findListeEtudiant(Request $request, $id, GroupeRepository $groupeRepository, Groupe $groupe, ManagerRegistry $doctrine)
    {

        $prof = $doctrine->getRepository(Professeur::class)->findAll();


        $groupe = $groupeRepository->find($id);
        // dd($groupe);
        return $this->renderForm(
            'findEtudiantListe.html.twig',
            [
                "groupe" => $groupe,
                'prof' => $prof
            ]
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
