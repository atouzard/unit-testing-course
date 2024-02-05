<?php

namespace App\Controller;
use App\Entity\Adventurer;
use App\Form\AdventurerType;
use App\Repository\AdventurerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route(path: '/admin', name: 'admin_list', methods: ['GET'])]
    public function index(
        AdventurerRepository $adventurerRepository,
    ): Response
    {
        $adventurers = $adventurerRepository->findAll();

        return $this->render('admin/listAdventurers.html.twig', [
            'adventurers' => $adventurers,
        ]);
    }

    #[Route('/admin/adventurer/new', name: 'admin_adventurer_create', methods: ['GET', 'POST'])]
    public function createAdventurer(
        EntityManagerInterface $entityManager,
        Request $request,
    )
    {
        $form = $this->createForm(AdventurerType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adventurer = new Adventurer(
                $form->getData()['name'],
                $form->getData()['class'],
                $form->getData()['health'],
            );
            $entityManager->persist($adventurer);
            $entityManager->flush();
            $this->addFlash('success', 'Adventurer created !');
        }

        return $this->render('admin/adventurerCreate.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
