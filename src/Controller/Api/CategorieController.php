<?php

namespace App\Controller\Api;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/api/categorie', name: 'api_categorie_')]
class CategorieController extends AbstractController
{
    #[Route('s', name: 'index')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();

        return $this->json(data: $categories, context: ['groups' => 'api_categories_index']);
    }

    #[Route('/{nom}', name: 'show')]
    public function show(Categorie $categorie): Response
    {
        return $this->json(data: $categorie, context: ['groups' => ['api_categories_show']]);
    }
}
