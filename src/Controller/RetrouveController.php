<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RetrouveController extends AbstractController
{
    #[Route('/retrouve/{email}', name: 'app_retrouve')]
    public function index(): Response
    {
        return $this->render('retrouve/index.html.twig', [
            'controller_name' => 'RetrouveController',
        ]);
    }
}
