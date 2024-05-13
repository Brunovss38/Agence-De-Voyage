<?php

namespace App\Entity;

use App\Repository\VoyageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: VoyageRepository::class)]
class Voyage
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['api_voyages_index', 'api_reservations_index'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_voyages_index', 'api_voyages_show', 'api_categories_show', 'api_pays_show'])]
    private ?string $NomVoyage = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_voyages_index', 'api_voyages_show'])]
    private ?string $Description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_voyages_index', 'api_voyages_show', 'api_categories_show', 'api_pays_show'])]
    private ?string $Photo = null;

    #[ORM\Column(length: 255)]
    #[Groups(['api_voyages_index'])]
    private ?string $Prix = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['api_voyages_index', 'api_voyage_date'])]
    private ?\DateTimeInterface $Depart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['api_voyages_index', 'api_voyage_date'])]
    private ?\DateTimeInterface $Retour = null;

    #[ORM\ManyToOne(inversedBy: 'voyages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $Reserver = null;
    #[Groups(['api_voyages_index'])]

    /**
     * @var Collection<int, Pays>
     */
    #[ORM\ManyToMany(targetEntity: Pays::class, inversedBy: 'voyages')]

    private Collection $Vers;


    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'voyages')]
    private Collection $appartient;

    /**
     * @var Collection<int, Formulaire>
     */
    #[ORM\OneToMany(targetEntity: Formulaire::class, mappedBy: 'voyage')]
    private Collection $Avoir;

    #[ORM\ManyToOne(inversedBy: 'Reserver')]
    private ?User $UserVoyage = null;

    public function __construct()
    {
        $this->Vers = new ArrayCollection();
        $this->appartient = new ArrayCollection();
        $this->Avoir = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVoyage(): ?string
    {
        return $this->NomVoyage;
    }

    public function setNomVoyage(string $NomVoyage): static
    {
        $this->NomVoyage = $NomVoyage;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->Photo;
    }

    public function setPhoto(string $Photo): static
    {
        $this->Photo = $Photo;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(string $Prix): static
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getDepart(): ?\DateTimeInterface
    {
        return $this->Depart;
    }

    public function setDepart(\DateTimeInterface $Depart): static
    {
        $this->Depart = $Depart;

        return $this;
    }

    public function getRetour(): ?\DateTimeInterface
    {
        return $this->Retour;
    }

    public function setRetour(\DateTimeInterface $Retour): static
    {
        $this->Retour = $Retour;

        return $this;
    }

    public function getReserver(): ?User
    {
        return $this->Reserver;
    }

    public function setReserver(?User $Reserver): static
    {
        $this->Reserver = $Reserver;

        return $this;
    }

    /**
     * @return Collection<int, Pays>
     */
    public function getVers(): Collection
    {
        return $this->Vers;
    }

    public function addVer(Pays $ver): static
    {
        if (!$this->Vers->contains($ver)) {
            $this->Vers->add($ver);
        }

        return $this;
    }

    public function removeVer(Pays $ver): static
    {
        $this->Vers->removeElement($ver);

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getAppartient(): Collection
    {
        return $this->appartient;
    }

    public function addAppartient(Categorie $appartient): static
    {
        if (!$this->appartient->contains($appartient)) {
            $this->appartient->add($appartient);
        }

        return $this;
    }

    public function removeAppartient(Categorie $appartient): static
    {
        $this->appartient->removeElement($appartient);

        return $this;
    }

    /**
     * @return Collection<int, Formulaire>
     */
    public function getAvoir(): Collection
    {
        return $this->Avoir;
    }

    public function addAvoir(Formulaire $avoir): static
    {
        if (!$this->Avoir->contains($avoir)) {
            $this->Avoir->add($avoir);
            $avoir->setVoyage($this);
        }

        return $this;
    }

    public function removeAvoir(Formulaire $avoir): static
    {
        if ($this->Avoir->removeElement($avoir)) {
            // set the owning side to null (unless already changed)
            if ($avoir->getVoyage() === $this) {
                $avoir->setVoyage(null);
            }
        }

        return $this;
    }

    public function getUserVoyage(): ?User
    {
        return $this->UserVoyage;
    }

    public function setUserVoyage(?User $UserVoyage): static
    {
        $this->UserVoyage = $UserVoyage;

        return $this;
    }
}
