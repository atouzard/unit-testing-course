<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Adventurer;
use PHPUnit\Framework\TestCase;

class AdventurerTest extends TestCase
{
    public function testAdventurerGettersShouldSucceed(): void
    {
        $adventurer = new Adventurer('Anne', 'Cleric', 2);

        $this->assertSame('Anne', $adventurer->getName());
        $this->assertSame('Cleric', $adventurer->getClass());
        $this->assertSame(2, $adventurer->getHealth());
    }

    public function adventurerHealthDescriptionDataProvider(): \Generator
    {
        yield 'adventurer has 18 health should be fine' => [18, 'fine'];
        yield 'adventurer has 15 health should be fine' => [15, 'fine'];
        yield 'adventurer has 8 health should be wounded' => [8, 'wounded'];
        yield 'adventurer has 2 health should be wounded' => [2, 'badly wounded'];
        yield 'adventurer has 0 health should be dead' => [0, 'dead'];
        yield 'adventurer has -5 health should be dead' => [-5, 'dead'];
    }

    /**
     * @dataProvider adventurerHealthDescriptionDataProvider
     */
    public function testAdventurerHealthDescription(int $health, string $description): void
    {
        $adventurer = new Adventurer('Anne', 'Cleric', $health);

        $this->assertSame($description, $adventurer->getHealthDescription());
    }

    public function adventurerStatusAvailabilityDataProvider(): \Generator
    {
        yield 'A available adventurer with 10 HP should be available' => ['available', 10, true];
        yield 'A sleeping adventurer with 10 HP should not be available' => ['sleeping', 10, false];
        yield 'A sick adventurer with 10 HP should not be available' => ['sick', 10, false];
        yield 'A available adventurer with 6 HP should not be available' => ['available', 6, false];
        yield 'A available adventurer with 2 HP should not be available' => ['available', 2, false];
        yield 'A available adventurer with —2 HP should not be available' => ['available', -2, false];
        yield 'A eating adventurer with 6 HP should not be available' => ['eating', 6, false];
        yield 'A poisoned adventurer with 6 HP should not be available' => ['poisoned', 12, false];
    }

    /**
     * @dataProvider adventurerStatusAvailabilityDataProvider
     */
    public function testAdventurerAvailability(string $status, int $health, bool $available): void
    {
        $adventurer = new Adventurer('Anne', 'Cleric', $health);
        $adventurer->setStatus($status);

        $this->assertSame($available, $adventurer->isAvailable());
    }
}
