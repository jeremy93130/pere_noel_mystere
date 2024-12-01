<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendInvitation(string $from, string $to, string $groupName): void
    {
        $email = (new Email())
            ->from('jeremy.dubrulle75000@gmail.com') // L'adresse Gmail configurée
            ->to($to)
            ->subject("Invitation pour le Père Noël Mystère - $groupName")
            ->html("
                <p>Bonjour,</p>
                <p>Vous êtes invité par <strong> $from </strong> à participer au Père Noël Mystère du groupe <strong>$groupName</strong> !</p>
                <p>Veuillez confirmer votre participation en cliquant sur le lien suivant :</p>
                <a href='http://localhost:8000/confirm/$groupName'>Confirmer ma participation</a>
            ");

        $this->mailer->send($email);
    }
}
