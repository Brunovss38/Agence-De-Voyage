<?php

namespace App\Entity;

use App\Repository\StatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StatutRepository::class)]
#[UniqueEntity(fields: 'nom', message: 'Ce statut existe déjà.')]
class Statut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['api_reservations_index'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Intitule = null;

    /**
     * @var Collection<int, Formulaire>
     */
    #[ORM\OneToMany(targetEntity: Formulaire::class, mappedBy: 'statut')]
    private Collection $est;

    public function __construct()
    {
        $this->est = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->Intitule;
    }

    public function setIntitule(string $Intitule): static
    {
        $this->Intitule = $Intitule;

        return $this;
    }

    /**
     * @return Collection<int, Formulaire>
     */
    public function getEst(): Collection
    {
        return $this->est;
    }

    public function addEst(Formulaire $est): static
    {
        if (!$this->est->contains($est)) {
            $this->est->add($est);
            $est->setStatut($this);
        }

        return $this;
    }

    public function removeEst(Formulaire $est): static
    {
        if ($this->est->removeElement($est)) {
            // set the owning side to null (unless already changed)
            if ($est->getStatut() === $this) {
                $est->setStatut(null);
            }
        }

        return $this;
    }
}
