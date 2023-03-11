<?php

namespace App\Entity;

use App\Repository\SCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\EventListener\SCategorieListener;
use App\Entity\Categorie;

#[ORM\Entity(repositoryClass: SCategorieRepository::class)]
#[UniqueEntity(
    fields: ['numero', 'categorie'],
    errorPath: 'numero',
    message: 'Le numéro est déjà utilisé pour cette catégorie.',
)]

class SCategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $libelle = null;
     
    #[ORM\ManyToOne(targetEntity: Categorie::class,inversedBy: 'sCategories')]
    private ?Categorie $categorie = null;

    #[ORM\Column]
    private ?int $numero = null;

    public function __construct()
    {
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }


    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
}
