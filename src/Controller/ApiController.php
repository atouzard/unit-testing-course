<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route(path: '/api/adventurers', name: 'api_adventurers_list', methods: ['GET'])]
    public function index(): Response
    {
        return $this->json([
            ['name' => 'Anne', 'status' => 'sleeping'],
            ['name' => 'Pierre', 'status' => 'working'],
            ['name' => 'Dartagnan', 'status' => 'ready'],
            ['name' => 'Dennis', 'status' => 'eating'],
        ]);
    }
}
