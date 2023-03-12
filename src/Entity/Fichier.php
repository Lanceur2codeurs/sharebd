<?php

namespace App\Entity;

use App\Repository\FichierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FichierRepository::class)]
class Fichier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nomOriginal = null;

    #[ORM\Column(length: 255)]
    private ?string $nomServeur = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEnvoi = null;

    #[ORM\Column(length: 10)]
    private ?string $extension = null;

    #[ORM\Column]
    private ?int $taille = null;

    #[ORM\OneToMany(mappedBy: 'fichier', targetEntity: Telecharger::class)]
    private Collection $telechargers;

    #[ORM\ManyToOne(inversedBy: 'fichiers')]
    private ?User $proprietaire = null;

    #[ORM\ManyToMany(targetEntity: SCategorie::class, inversedBy: 'fichiers')]
    private Collection $lesSousCategories;

    

    public function __construct()
    {
        $this->telechargers = new ArrayCollection();
        $this->lesSousCategories = new ArrayCollection();
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomOriginal(): ?string
    {
        return $this->nomOriginal;
    }

    public function setNomOriginal(string $nomOriginal): self
    {
        $this->nomOriginal = $nomOriginal;

        return $this;
    }

    public function getNomServeur(): ?string
    {
        return $this->nomServeur;
    }

    public function setNomServeur(string $nomServeur): self
    {
        $this->nomServeur = $nomServeur;

        return $this;
    }

    public function getDateEnvoi(): ?\DateTimeInterface
    {
        return $this->dateEnvoi;
    }

    public function setDateEnvoi(\DateTimeInterface $dateEnvoi): self
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * @return Collection<int, Telecharger>
     */
    public function getTelechargers(): Collection
    {
        return $this->telechargers;
    }

    public function addTelecharger(Telecharger $telecharger): self
    {
        if (!$this->telechargers->contains($telecharger)) {
            $this->telechargers->add($telecharger);
            $telecharger->setFichier($this);
        }

        return $this;
    }

    public function removeTelecharger(Telecharger $telecharger): self
    {
        if ($this->telechargers->removeElement($telecharger)) {
            // set the owning side to null (unless already changed)
            if ($telecharger->getFichier() === $this) {
                $telecharger->setFichier(null);
            }
        }

        return $this;
    }

    public function getProprietaire(): ?User
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?User $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    /**
     * @return Collection<int, SCategorie>
     */
    public function getLesSousCategories(): Collection
    {
        return $this->lesSousCategories;
    }

    public function addLesSousCategory(SCategorie $lesSousCategory): self
    {
        if (!$this->lesSousCategories->contains($lesSousCategory)) {
            $this->lesSousCategories->add($lesSousCategory);
        }

        return $this;
    }

    public function removeLesSousCategory(SCategorie $lesSousCategory): self
    {
        $this->lesSousCategories->removeElement($lesSousCategory);

        return $this;
    }

   
}
