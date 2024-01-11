<?php

namespace App\Controller;

use App\Repository\AdventurerRepository;
use App\Repository\AlertRepository;
use App\Service\AlertHelper;
use App\Service\AdventurerApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route(path: '/', name: 'main_controller', methods: ['GET'])]
    public function index(
        AdventurerRepository $adventurerRepository,
        AdventurerApiService $statusApiService,
        AlertRepository      $alertRepository,
    ): Response
    {
        $adventurers = $adventurerRepository->findAll();

        $adventurers = $statusApiService->updateStatuses($adventurers);

        return $this->render('main/index.html.twig', [
            'adventurers' => $adventurers,
        ]);
    }

    #[Route('/alert/end', name: 'app_alert_end', methods: ['POST'])]
    public function endLockDown(Request $request, AlertHelper $alertHelper): Response
    {
        if (!$this->isCsrfTokenValid('end-lockdown', $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Invalid CSRF token');
        }

        dump('TODO: resolve alert');die;
    }
}
