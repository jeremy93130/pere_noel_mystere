<?php

namespace App\Command;

use App\Service\EmailService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'test-email',
    description: 'Add a short description for your command',
)]
class TestEmailCommand extends Command
{
    protected static $defaultName = "test-email";
    private EmailService $emailService;
    public function __construct(EmailService $emailService)
    {
        parent::__construct();
        $this->emailService = $emailService;
    }

    protected function configure(): void
    {
        $this->setDescription('Tester l\'envoi d\'un email');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $from = 'jess.vanderbilt1@gmail.com';
        $to = 'jerem-du-75020@hotmail.fr';
        $groupName = 'Dubreuil';

        try {
            $this->emailService->sendInvitation($from, $to, $groupName);
            $output->writeln('<info> Email envoyé avec succès </info>');
        } catch (\Exception $e) {
            $output->writeln('<error>Erreur: ' . $e->getMessage() . '</error>');
        }

        return Command::SUCCESS;
    }
}
