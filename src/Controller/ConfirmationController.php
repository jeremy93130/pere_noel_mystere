<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConfirmationController extends AbstractController
{
    #[Route('/confirmation', name: 'app_confirmation')]
    public function index(): Response
    {
        return $this->render('confirmation/index.html.twig', [
            'controller_name' => 'Les invitations ont bien été envoyées',
        ]);
    }
}
