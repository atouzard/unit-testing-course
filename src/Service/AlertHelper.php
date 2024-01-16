<?php

namespace App\Service;

use App\Repository\AlertRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AlertHelper
{
    public function __construct(
        private AlertRepository $alertRepository,
        private EntityManagerInterface $entityManager,
        private AdventurerApiService $adventurerApiService,
        private MailerInterface $mailer,
    )
    {
    }

    public function endAlert(): void
    {
        $alert = $this->alertRepository->findMostRecent();

        if ($alert->isActive()) {
            $alert->setActive(false);
            $this->entityManager->persist($alert);
            $this->entityManager->flush();
        } else {
            throw new \RuntimeException('There is no alert');
        }

        $this->adventurerApiService->clearAlertNotification();

        $this->mailer->send(
            (new Email())
                ->from('contact@guild.fr')
                ->to('staff@guild.fr')
                ->subject('Alert Finished')
                ->text('All good man !')
        );
    }
}
