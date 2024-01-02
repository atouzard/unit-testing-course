<?php

namespace App\Controller;

use App\Entity\Adventurer;
use App\Repository\AdventurerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route(path: '/', name: 'main_controller', methods: ['GET'])]
    public function index(): Response
    {
        $adventurers = [
            new Adventurer('Anne', 'Cleric', 2),
            new Adventurer('Pierre','Ranger', 7),
            new Adventurer('Dartagnan', 'Swashbuckler', 15),
            new Adventurer('Dennis', 'Paladin', 6),
            new Adventurer('Jeanne', 'Fighter', 10),
        ];

        return $this->render('main/index.html.twig', [
            'adventurers' => $adventurers,
        ]);
    }
}
