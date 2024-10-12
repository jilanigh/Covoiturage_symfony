<?php

namespace App\Entity;

use App\Repository\PassagerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PassagerRepository::class)]
class Passager extends User
{
/*    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;*/

    #[ORM\Column]
    private ?float $moyenneEvaluation = null;

    #[ORM\ManyToOne(inversedBy: 'passagers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?trajet $trajet = null;

/*    public function getId(): ?int
    {
        return $this->id;
    }*/

    public function getMoyenneEvaluation(): ?float
    {
        return $this->moyenneEvaluation;
    }

    public function setMoyenneEvaluation(float $moyenneEvaluation): static
    {
        $this->moyenneEvaluation = $moyenneEvaluation;

        return $this;
    }

    public function getTrajet(): ?trajet
    {
        return $this->trajet;
    }

    public function setTrajet(?trajet $trajet): static
    {
        $this->trajet = $trajet;

        return $this;
    }
}
