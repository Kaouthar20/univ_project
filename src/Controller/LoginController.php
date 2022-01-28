<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('etudiant_liste');
        }
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $username = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', [
            'username' => $username,
            'error'         => $error,
        ]);
    }
    /**
     * @Route("/logout", name="logout", methods={"GET"})
     */
    public function logout()
    {
    }
}
