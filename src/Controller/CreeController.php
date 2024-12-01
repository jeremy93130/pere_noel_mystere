<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CreeController extends AbstractController
{
    #[Route('/cree', name: 'app_cree')]
    public function index(): Response
    {
        return $this->render('cree/index.html.twig', [
            'controller_name' => 'CreeController',
        ]);
    }
}
