<?php

namespace App\Entity;

use App\Repository\TrajetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrajetRepository::class)]
class Trajet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pointDepart = null;

    #[ORM\Column(length: 255)]
    private ?string $pointArrivee = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $heurDepart = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?int $placesDisponibles = null;

    #[ORM\ManyToOne(inversedBy: 'trajet')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Chauffeur $chauffeur = null;

    /**
     * @var Collection<int, Passager>
     */
    #[ORM\OneToMany(targetEntity: Passager::class, mappedBy: 'trajet')]
    private Collection $passagers;

    public function __construct()
    {
        $this->passagers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPointDepart(): ?string
    {
        return $this->pointDepart;
    }

    public function setPointDepart(string $pointDepart): static
    {
        $this->pointDepart = $pointDepart;

        return $this;
    }

    public function getPointArrivee(): ?string
    {
        return $this->pointArrivee;
    }

    public function setPointArrivee(string $pointArrivee): static
    {
        $this->pointArrivee = $pointArrivee;

        return $this;
    }

    public function getHeurDepart(): ?\DateTimeInterface
    {
        return $this->heurDepart;
    }

    public function setHeurDepart(\DateTimeInterface $heurDepart): static
    {
        $this->heurDepart = $heurDepart;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPlacesDisponibles(): ?int
    {
        return $this->placesDisponibles;
    }

    public function setPlacesDisponibles(int $placesDisponibles): static
    {
        $this->placesDisponibles = $placesDisponibles;

        return $this;
    }

    public function getChauffeur(): ?Chauffeur
    {
        return $this->chauffeur;
    }

    public function setChauffeur(?Chauffeur $chauffeur): static
    {
        $this->chauffeur = $chauffeur;

        return $this;
    }

    /**
     * @return Collection<int, Passager>
     */
    public function getPassagers(): Collection
    {
        return $this->passagers;
    }

    public function addPassager(Passager $passager): static
    {
        if (!$this->passagers->contains($passager)) {
            $this->passagers->add($passager);
            $passager->setTrajet($this);
        }

        return $this;
    }

    public function removePassager(Passager $passager): static
    {
        if ($this->passagers->removeElement($passager)) {
            // set the owning side to null (unless already changed)
            if ($passager->getTrajet() === $this) {
                $passager->setTrajet(null);
            }
        }

        return $this;
    }
}
