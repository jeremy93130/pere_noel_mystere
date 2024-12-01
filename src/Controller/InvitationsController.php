<?php

namespace App\Controller;

use App\Entity\Guest;
use App\Entity\User;
use App\Form\InvitationsType;
use App\Repository\FamillyGroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InvitationsController extends AbstractController
{
    #[Route('/invitations/{id}', name: 'app_invitations')]
    public function index($id, Request $request, FamillyGroupRepository $famillyGroupRepository, EntityManagerInterface $entityManagerInterface): Response
    {
        $form = $this->createForm(InvitationsType::class);
        $form->handleRequest($request);
        // Traitement des emails principaux et secondaires
        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User;
            $famillyGroup = $famillyGroupRepository->find($id);
            $data = $form->getData();
            $emailPrincipal = $form->get('email')->getData();
            $emailsInvites = $form->get('emails')->getData();
            if (isset($emailPrincipal)) {
                $user->setEmail($emailPrincipal);
                $user->setFamillyGroup($famillyGroup);
                $entityManagerInterface->persist($user);
            } else {
                throw new \Exception('Veuillez Entrer votre adresse email');
            }
            if (isset($emailsInvites)) {
                foreach ($emailsInvites as $email) {
                    $guest = new Guest;
                    $guest->setEmail($email);
                    $guest->setFamillygroup($famillyGroup);

                    $famillyGroup->addGuest($guest);

                    $entityManagerInterface->persist($guest);
                }

                $entityManagerInterface->flush();
            }



            return $this->redirectToRoute('success_page');
        }

        return $this->render('invitations/index.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
