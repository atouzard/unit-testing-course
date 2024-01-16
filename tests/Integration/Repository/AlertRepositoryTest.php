<?php

namespace App\Tests\Integration\Repository;
use App\Factory\AlertFactory;
use App\Repository\AlertRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;

class AlertRepositoryTest extends KernelTestCase
{
    use ResetDatabase;

    public function testIsInAlertShouldBeFalseIfThereIsNoAlertRow(): void
    {
        self::bootKernel();

        $repository = self::getContainer()->get(AlertRepository::class);

        $this->assertFalse($repository->isInAlert());
    }

    public function testIsInAlertShouldBeTrueIfThereIsAnActiveAlert(): void
    {
        self::bootKernel();

        AlertFactory::createOne(['active'=>true]);

        $repository = self::getContainer()->get(AlertRepository::class);
        $this->assertTrue($repository->isInAlert());
    }
}
