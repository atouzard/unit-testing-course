<?php

namespace App\Command;

use App\Entity\Alert;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:alert:create',
    description: 'Add a short description for your command',
)]
class AlertCreateCommand extends Command
{
    public function __construct(private EntityManagerInterface $manager)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $alert = new Alert();
        $alert->setActive(true);
        $alert->setReason('Big Alert !');
        $this->manager->persist($alert);
        $this->manager->flush();

        return Command::SUCCESS;
    }
}
