<?php

namespace App\Controller;

use App\Entity\Guest;
use App\Entity\User;
use App\Form\InvitationsType;
use App\Repository\FamillyGroupRepository;
use App\Repository\UserRepository;
use App\Service\EmailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class InvitationsController extends AbstractController
{
    #[Route('/invitations/{id}', name: 'app_invitations')]
    public function index($id, Request $request, FamillyGroupRepository $famillyGroupRepository, EntityManagerInterface $entityManagerInterface, EmailService $emailService, UserRepository $userRepository, UrlGeneratorInterface $urlGenerator): Response
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

            try {
                if (isset($emailPrincipal)) {
                    $user->setEmail($emailPrincipal);
                    $user->setFamillyGroup($famillyGroup);


                    if (!$userRepository->findOneBy(['email' => $emailPrincipal])) {
                        $entityManagerInterface->persist($user);
                    } else {
                        throw new \Exception("L'adresse mail est déjà enregistrée chez nous !");
                    }
                } else {
                    throw new \Exception('Veuillez Entrer votre adresse email');
                }
            } catch (\Exception $e) {
                $this->addFlash('error', $e->getMessage());
                return $this->redirectToRoute('app_registration');
            }

            if (isset($emailsInvites)) {
                foreach ($emailsInvites as $email) {
                    $guest = new Guest;
                    $guest->setEmail($email);
                    $guest->setFamillygroup($famillyGroup);

                    $famillyGroup->addGuest($guest);

                    $entityManagerInterface->persist($guest);
                    $emailService->sendInvitation($emailPrincipal, $email, $famillyGroup->getName());
                }

                $entityManagerInterface->flush();
            }



            return $this->redirectToRoute('success_page');
        }

        return $this->render('invitations/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/liste/{id}', name: 'app_liste')]
    public function liste(Session $session, $id)
    {
        $liste = $session->get('familly' . $id, []);

        $form = $this->createForm(InvitationsType::class);
        return $this->render('invitations/liste.html.twig', [
            'form' => $form,
            'liste' => $liste
        ]);
    }
}
