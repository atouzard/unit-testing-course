<?php

namespace App\Tests\Unit\Service;
use App\Entity\Adventurer;
use App\Service\AdventurerApiService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class AdventurersApiServiceTest extends TestCase
{
    public function testAdventurersApiService(): void
    {

        $response = new MockResponse('[
  {
    "name": "Anne",
    "status": "ready"
  },
  {
    "name": "Dennis",
    "status": "eating"
  }
]');
        $client = new MockHttpClient($response);

        $service = new AdventurerApiService($client);

        $adventurers = [
            new Adventurer('Anne', 'Cleric', 0),
            new Adventurer('Dennis', 'Paladin', 6),
            new Adventurer('Jeanne', 'Fighter', 10),
        ];

        $adventurers = $service->updateStatuses($adventurers);

        $this->assertSame(false, $adventurers[0]->isAvailable());
        $this->assertSame(false, $adventurers[1]->isAvailable());
        $this->assertSame(true, $adventurers[2]->isAvailable());
    }

    public function testUpdateStatusesWithNotFoundAdventurerShouldThrowAnError(): void
    {
        $response = new MockResponse('[{"name": "Anne","status": "sleeping"}]');
        $client = new MockHttpClient($response);

        $service = new AdventurerApiService($client);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Adventurer Anne not found');

        $service->updateStatuses([]);
    }
}
