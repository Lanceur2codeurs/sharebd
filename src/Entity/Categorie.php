<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: SCategorie::class)]
    private Collection $sCategories;

    public function __construct()
    {
        $this->sCategories = new ArrayCollection();
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

    /**
     * @return Collection<int, SCategorie>
     */
    public function getSCategories(): Collection
    {
        return $this->sCategories;
    }

    public function addSCategory(SCategorie $sCategory): self
    {
        if (!$this->sCategories->contains($sCategory)) {
            $this->sCategories->add($sCategory);
            $sCategory->setCategorie($this);
        }

        return $this;
    }

    public function removeSCategory(SCategorie $sCategory): self
    {
        if ($this->sCategories->removeElement($sCategory)) {
            // set the owning side to null (unless already changed)
            if ($sCategory->getCategorie() === $this) {
                $sCategory->setCategorie(null);
            }
        }

        return $this;
    }
}
