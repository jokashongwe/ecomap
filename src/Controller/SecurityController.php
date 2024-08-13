<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@EasyAdmin/page/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
            'translation_domain' => 'admin',
            'page_title' => 'Admin Panel',
            'csrf_token_intention' => 'authenticate',
            'target_path' => $this->generateUrl('admin'),
            'username_label' => 'Utilisateur',
            'password_label' => 'Mot de passe',
            'sign_in_label' => 'Se connecter',
            'remember_me_enabled' => true,
            'remember_me_label' => 'Rester Connecter',
        ]);
    }
}
