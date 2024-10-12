<?php

namespace App\Entity;

use App\Repository\ChauffeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChauffeurRepository::class)]
class Chauffeur extends User
{

/*    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;*/

    #[ORM\Column]
    private ?bool $permisConduire = null;

    /**
     * @var Collection<int, trajet>
     */
    #[ORM\OneToMany(targetEntity: trajet::class, mappedBy: 'chauffeur', orphanRemoval: true)]
    private Collection $trajet;

    #[ORM\OneToOne(mappedBy: 'chauffeur', cascade: ['persist', 'remove'])]
    private ?Voiture $voiture = null;

    public function __construct()
    {
        $this->trajet = new ArrayCollection();
    }

/*    public function getId(): ?int
    {
        return $this->id;
    }*/

    public function isPermisConduire(): ?bool
    {
        return $this->permisConduire;
    }

    public function setPermisConduire(bool $permisConduire): static
    {
        $this->permisConduire = $permisConduire;

        return $this;
    }
//hello jilani
    /**
     * @return Collection<int, trajet>
     */
    public function getTrajet(): Collection
    {
        return $this->trajet;
    }

    public function addTrajet(trajet $trajet): static
    {
        if (!$this->trajet->contains($trajet)) {
            $this->trajet->add($trajet);
            $trajet->setChauffeur($this);
        }

        return $this;
    }

    public function removeTrajet(trajet $trajet): static
    {
        if ($this->trajet->removeElement($trajet)) {
            // set the owning side to null (unless already changed)
            if ($trajet->getChauffeur() === $this) {
                $trajet->setChauffeur(null);
            }
        }

        return $this;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(Voiture $voiture): static
    {
        // set the owning side of the relation if necessary
        if ($voiture->getChauffeur() !== $this) {
            $voiture->setChauffeur($this);
        }

        $this->voiture = $voiture;

        return $this;
    }
}
