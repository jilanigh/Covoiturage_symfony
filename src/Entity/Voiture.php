<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $annee = null;

    #[ORM\Column(length: 255)]
    private ?string $immat = null;

    #[ORM\Column]
    private ?int $nbrPlaces = null;

    #[ORM\OneToOne(targetEntity: self::class, mappedBy: 'chauffeur', cascade: ['persist', 'remove'])]
    private ?self $voiture = null;

    #[ORM\OneToOne(inversedBy: 'voiture', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?chauffeur $chauffeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getImmat(): ?string
    {
        return $this->immat;
    }

    public function setImmat(string $immat): static
    {
        $this->immat = $immat;

        return $this;
    }

    public function getNbrPlaces(): ?int
    {
        return $this->nbrPlaces;
    }

    public function setNbrPlaces(int $nbrPlaces): static
    {
        $this->nbrPlaces = $nbrPlaces;

        return $this;
    }

    public function getVoiture(): ?self
    {
        return $this->voiture;
    }

    public function setVoiture(self $voiture): static
    {
        // set the owning side of the relation if necessary
        if ($voiture->getChauffeur() !== $this) {
            $voiture->setChauffeur($this);
        }

        $this->voiture = $voiture;

        return $this;
    }

    public function getChauffeur(): ?chauffeur
    {
        return $this->chauffeur;
    }

    public function setChauffeur(chauffeur $chauffeur): static
    {
        $this->chauffeur = $chauffeur;

        return $this;
    }
}
