<?php

namespace App\Controller\Api;

use App\Entity\Voyage;
use App\Repository\VoyageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/api/voyage', name: 'api_voyage_')]
class VoyageController extends AbstractController
{
    #[Route('s', name: 'index')]
    public function index(VoyageRepository $voyageRepository): Response
    {
        $voyages = $voyageRepository->findAll();

        return $this->json(data: $voyages, context: ['groups' => 'api_voyages_index']);
    }

    #[Route('/{nom}', name: 'show')]
    public function show(Voyage $voyage): Response
    {
        return $this->json(data: $voyage, context: ['groups' => ['api_voyages_index', 'api_voyages_show']]);
    }

    #[Route('/{nom}', name: 'date')]
    public function date(Voyage $voyage): Response
    {
        return $this->json(data: $voyage, context: ['groups' => ['api_voyages_index', 'api_voyages_show', 'api_voyages_date']]);
    }
}
