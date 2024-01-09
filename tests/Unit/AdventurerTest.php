<?php

namespace App\Tests\Unit;
use App\Entity\Adventurer;
use PHPUnit\Framework\TestCase;

class AdventurerTest extends TestCase
{
    public function testAdventurerHealthIsGreaterThan10(): void
    {
        $adventurer = new Adventurer('Richard', 'Knight', 15);

        $this->assertGreaterThan(
            10,
            $adventurer->getHealth(),
            'Adventurer has health superior than 10'
        );

        $this->assertSame('Richard', $adventurer->getName());
        $this->assertSame('Knight', $adventurer->getClass());
        $this->assertSame(15, $adventurer->getHealth());
    }

    /**
     * @dataProvider healthDescriptionDataProvider
     */
    public function testHealthDescription(
        string $result,
        int $healthPoints,
    ): void
    {
        $adventurer = new Adventurer('Philippe', 'Archer', $healthPoints);
        $this->assertSame(
            $result,
            $adventurer->getHealthDescription()
        );
    }

    private function healthDescriptionDataProvider(): \Generator
    {
        yield 'Good with 15 PV' => ['Good', 15];
        yield 'Wounded with 7 PV' => ['Wounded', 7];
        yield 'Dead with 0 PV' => ['Dead', 0];
    }

    /**
     * @dataProvider statusDataProvider
     */
    public function testAdventurerNotAvailableDependingOnStatus(
        bool $isAvailable,
        ?string $status,
    ): void
    {
        $adventurer = new Adventurer('Léa', 'Mage', 15);
        $adventurer->setStatus($status);

        $this->assertSame($isAvailable, $adventurer->isAvailable());
    }

    private function statusDataProvider(): \Generator
    {
        yield 'unavailable while sleeping' => [false, 'sleeping'];
        yield 'unavailable while working' => [false, 'working'];
        yield 'available while ready' => [true, 'ready'];
        yield 'available while no status' => [true, null];
    }

    public function testAdventurerShouldBeUnavailableIf0Health(): void
    {
        $adventurer = new Adventurer('Bob', 'Bard', 0);
        $this->assertFalse($adventurer->isAvailable());
    }
}
