<?php

namespace App\Controller;

use App\Repository\GroupeRepository;
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
}
