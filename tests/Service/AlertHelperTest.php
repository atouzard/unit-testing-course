<?php

namespace App\Tests\Service;

use App\Factory\AlertFactory;
use App\Repository\AlertRepository;
use App\Service\AdventurerApiService;
use App\Service\AlertHelper;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\Test\ResetDatabase;
use Zenstruck\Mailer\Test\InteractsWithMailer;

class AlertHelperTest extends KernelTestCase
{
    use ResetDatabase;
    use InteractsWithMailer;

    public function testEndAlertShouldSucceedIfWeHaveAnActiveAlert(): void
    {
        self::bootKernel();

        $apiService = $this->createMock(AdventurerApiService::class);

        $apiService
            ->expects($this->once())
            ->method('clearAlertNotification')
        ;

        self::getContainer()->set(AdventurerApiService::class, $apiService);

        $alertHelper = self::getContainer()->get(AlertHelper::class);
        $repository = self::getContainer()->get(AlertRepository::class);

        AlertFactory::createOne(['active' => true]);

        $alertHelper->endAlert();

        $this->assertFalse($repository->isInAlert());
        $this->mailer()->assertSentEmailCount(1);
    }
}
