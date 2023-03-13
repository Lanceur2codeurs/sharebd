<?php

namespace App\Entity;

use App\Repository\PartagerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartagerRepository::class)]
class Partager
{
 
    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'partagers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'partagers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fichier $fichier = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'partagers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $usercible = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFichier(): ?Fichier
    {
        return $this->fichier;
    }

    public function setFichier(?Fichier $fichier): self
    {
        $this->fichier = $fichier;

        return $this;
    }

    public function getUsercible(): ?User
    {
        return $this->usercible;
    }

    public function setUsercible(?User $usercible): self
    {
        $this->usercible = $usercible;

        return $this;
    }
}
