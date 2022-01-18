<?php

namespace App\Controller;



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
}
