<?php

namespace App\Entity;

use App\Repository\FormulaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FormulaireRepository::class)]
class Formulaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Veuillez renseigner le nombre de voyageur.')]
    #[Groups(['api_reservations_index', 'api_reservation_new'])]
    private ?int $NombreDePlace = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Veuillez renseigner votre message.')]
    #[Groups(['api_reservations_index'])]
    private ?string $Message = null;

    #[ORM\ManyToOne(inversedBy: 'Avoir')]
    #[Groups(['api_reservations_index', 'api_reservation_new'])]
    private ?Voyage $voyage = null;

    #[ORM\ManyToOne(inversedBy: 'est')]
    #[Groups(['api_reservations_index', 'api_reservation_new'])]
    private ?Statut $statut = null;

    #[ORM\ManyToOne(inversedBy: 'envoi')]
    #[Groups(['api_reservations_index', 'api_reservation_new'])]
    private ?User $Formcontact = null;

    #[ORM\ManyToOne(inversedBy: 'envoi')]
    #[Groups(['api_reservations_index', 'api_reservation_new'])]
    private ?User $UserFormulaireContact = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreDePlace(): ?int
    {
        return $this->NombreDePlace;
    }

    public function setNombreDePlace(int $NombreDePlace): static
    {
        $this->NombreDePlace = $NombreDePlace;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->Message;
    }

    public function setMessage(string $Message): static
    {
        $this->Message = $Message;

        return $this;
    }

    public function getVoyage(): ?Voyage
    {
        return $this->voyage;
    }

    public function setVoyage(?Voyage $voyage): static
    {
        $this->voyage = $voyage;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getFormcontact(): ?User
    {
        return $this->Formcontact;
    }

    public function setFormcontact(?User $Formcontact): static
    {
        $this->Formcontact = $Formcontact;

        return $this;
    }

    public function getUserFormulaireContact(): ?User
    {
        return $this->UserFormulaireContact;
    }

    public function setUserFormulaireContact(?User $UserFormulaireContact): static
    {
        $this->UserFormulaireContact = $UserFormulaireContact;

        return $this;
    }
}
