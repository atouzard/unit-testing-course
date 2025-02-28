<?php

namespace App\Tests\Unit;

use App\Entity\Adventurer;
use App\Entity\AdventurerStatus;
use App\GithubService;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class GithubServiceTest extends TestCase
{


    private MockHttpClient $client;
    private MockResponse $response;

    protected function setUp(): void
    {
        parent::setUp();
        $this->response = new MockResponse(json_encode([
            ['title' => 'Marie', 'labels' => [['name' => 'eating']]],
            ['title' => 'Martin', 'labels' => [['name' => 'working']]],
        ]));
        $this->client = new MockHttpClient($this->response);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testGetGithubAdventurers(): void
    {
        $githubService = new GithubService(
            $this->createMock(LoggerInterface::class),
            $this->client,
        );

        /** @var Adventurer[] $adventurers */
        $adventurers = $githubService->getAdventurers();

        $this->assertCount(2, $adventurers);
        $this->assertSame('Marie', $adventurers[0]->getName());
        $this->assertSame(AdventurerStatus::EATING, $adventurers[0]->getStatus());
        $this->assertSame('Martin', $adventurers[1]->getName());
        $this->assertSame(AdventurerStatus::WORKING, $adventurers[1]->getStatus());
    }
}
