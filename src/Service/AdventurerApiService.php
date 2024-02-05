<?php

namespace App\Service;


use http\Client\Request;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class AdventurerApiService
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function clearAlertNotification(): void
    {
        // Do some Api Stuff
    }

    public function updateStatuses(array $adventurers): array
    {
        $response = $this->client->request('GET', 'http://localhost:8000/api/adventurers');

        foreach ($response->toArray() as $newAdventurer) {
            foreach ($adventurers as $adventurer) {
                if ($adventurer->getName() === $newAdventurer['name']) {
                    $adventurer->setStatus($newAdventurer['status']);
                    continue(2);
                }
            }
        }

        return $adventurers;
    }

    public function clearAlerts(): void
    {
        // TODO : This should makes an API call to resolve alert
    }
}
