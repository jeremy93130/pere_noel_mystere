<?php

namespace App\Service;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
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
        try {
            $email = (new Email())
                ->from('jess.vanderbilt1@gmail.com')
                ->to($to)
                ->subject("Invitation pour le Père Noël Mystère - $groupName")
                ->html("
                    <p>Bonjour,</p>
                    <p>Vous êtes invité par <strong>$from</strong> à participer au Père Noël Mystère du groupe <strong>$groupName</strong> !</p>
                    <p>Veuillez confirmer votre participation en cliquant sur le lien suivant :</p>
                    <a href='#'>Confirmer ma participation</a>
                ");

            $this->mailer->send($email);
            die('Email Envoyé ! ');
        } catch (TransportExceptionInterface $e) {
            // Log or handle the error
            // e.g., log it to a file or notify an admin
            error_log('Failed to send email: ' . $e->getMessage());
        }
    }
}
