<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'clients')]
    private ?Abonnement $abo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAbo(): ?Abonnement
    {
        return $this->abo;
    }

    public function setAbo(?Abonnement $abo): self
    {
        $this->abo = $abo;

        return $this;
    }
}
