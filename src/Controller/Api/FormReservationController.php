<?php

namespace App\Controller\Api;

use App\Entity\Formulaire;
use App\Repository\FormulaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;


#[Route('/api/reservation', name: 'api_reservation_')]
class FormReservationController extends AbstractController
{
    #[Route('s', name: 'index')]
    public function index(FormulaireRepository $formReservationController): Response
    {
        $reservations = $formReservationController->findAll();

        return $this->json(data: $reservations, context: ['groups' => 'api_reservations_index']);
    }

    
    #[Route('/new', name: "new", methods: ['POST'])]
    public function new(Request $request, EntityManagerInterface $em, SerializerInterface $serializer, ValidatorInterface $validator)
    {
       

        $reservation = $serializer->deserialize($request->getContent(), Formulaire::class, 'json', ['groups' => 'api_reservations_new']);

       
        
        $errors = $validator->validate($reservation);

      
        if ($errors->count()) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }

            return $this->json($messages, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            // On pense bien à enregistrer en BDD.
            $em->persist($reservation);
            $em->flush();

            return $this->json(null, Response::HTTP_CREATED);
        }
    }
}
