<?php

namespace App\Controller\Api;

use App\Entity\Pays;
use App\Repository\PaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/pays', name: 'api_pays_')]

class PaysController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(PaysRepository $paysRepository): Response
    {
        $pays = $paysRepository->findAll();

        return $this->json(data: $pays, context: ['groups' => 'api_pays_index']);
    }

    #[Route('/{nom}', name: 'show')]
    public function show(Pays $pays): Response
    {
        return $this->json(data: $pays, context: ['groups' => 'api_pays_show']);
    }
}
