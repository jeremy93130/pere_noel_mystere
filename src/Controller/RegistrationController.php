<?php

namespace App\Controller;

use App\Entity\FamillyGroup;
use App\Entity\User;
use App\Form\FamillyGroupeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/', name: 'app_registration')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $familly = new FamillyGroup();
        $form = $this->createForm(FamillyGroupeType::class, $familly);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($familly);
            $entityManager->flush();
            return $this->redirectToRoute('app_invitations', ['id' => $familly->getId()]);
        }
        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
            'form' => $form
        ]);
    }
}
