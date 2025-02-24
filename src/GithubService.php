<?php

namespace App;

use App\Entity\Adventurer;
use App\Entity\AdventurerStatus;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class GithubService
{

    public function __construct(
        private LoggerInterface $logger,
        private HttpClientInterface $client
    )
    {
    }

    public function getAdventurers(): array
    {
        $url = "https://api.github.com/repos/atouzard/sdw-testing-course/issues";
        $response = $this->client->request('GET', $url);

        $adventurers = [];

        foreach($response->toArray() as $issue) {
            $adv = new Adventurer(
                $issue['title'],
                'Unknown',
                20,
            );

            foreach ($issue['labels'] as $label) {
                $adv->setStatus(AdventurerStatus::tryFrom($label['name']));
            }
            $adventurers[] = $adv;
        }

        $this->logger->info(sprintf('%d Adventurers fetched from Github', count($adventurers)));

        return $adventurers;
    }
}