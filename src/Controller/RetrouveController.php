<?php

namespace App\Controller;

use App\Form\MailAssocieType;
use App\Repository\GuestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Attribute\Route;

class RetrouveController extends AbstractController
{
    #[Route('/retrouve', name: 'app_retrouve')]
    public function index(Request $request, GuestRepository $guestRepository, Session $session): Response
    {
        $form = $this->createForm(MailAssocieType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $familly = $guestRepository->findGuestsByUserEmail($form->get('email')->getData());

            if (!empty($familly)) {
                $famillyId = $familly[0]->getFamillygroup()->getId();
                $session->set('familly' . $famillyId, $familly);
                return $this->redirectToRoute('app_liste', ['id' => $famillyId]);
            }
        }
        return $this->render('retrouve/index.html.twig', [
            'controller_name' => 'RetrouveController',
            'form' => $form
        ]);
    }
}
