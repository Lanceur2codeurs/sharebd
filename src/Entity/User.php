<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(["client" => "Client"])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private ?bool $isVerified = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateInscription = null;

    #[ORM\Column(length: 30)]
    private ?string $nom = null;

    #[ORM\Column(length: 30)]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Telecharger::class)]
    private Collection $telechargers;

    #[ORM\OneToMany(mappedBy: 'proprietaire', targetEntity: Fichier::class)]
    private Collection $fichiers;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'accepters')]
    private Collection $accepter;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'accepter')]
    #[ORM\JoinTable(name: 'accepter')]
    private Collection $accepters;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Partager::class)]
    private Collection $partagers;

    public function __construct()
    {
        $this->telechargers = new ArrayCollection();
        $this->fichiers = new ArrayCollection();
        $this->accepter = new ArrayCollection();
        $this->accepters = new ArrayCollection();
        $this->partagers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->dateInscription;
    }

    public function setDateInscription(\DateTimeInterface $dateInscription): self
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

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
            $telecharger->setUser($this);
        }

        return $this;
    }

    public function removeTelecharger(Telecharger $telecharger): self
    {
        if ($this->telechargers->removeElement($telecharger)) {
            // set the owning side to null (unless already changed)
            if ($telecharger->getUser() === $this) {
                $telecharger->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Fichier>
     */
    public function getFichiers(): Collection
    {
        return $this->fichiers;
    }

    public function addFichier(Fichier $fichier): self
    {
        if (!$this->fichiers->contains($fichier)) {
            $this->fichiers->add($fichier);
            $fichier->setProprietaire($this);
        }

        return $this;
    }

    public function removeFichier(Fichier $fichier): self
    {
        if ($this->fichiers->removeElement($fichier)) {
            // set the owning side to null (unless already changed)
            if ($fichier->getProprietaire() === $this) {
                $fichier->setProprietaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAccepter(): Collection
    {
        return $this->accepter;
    }

    public function addAccepter(self $accepter): self
    {
        if (!$this->accepter->contains($accepter)) {
            $this->accepter->add($accepter);
        }

        return $this;
    }

    public function removeAccepter(self $accepter): self
    {
        $this->accepter->removeElement($accepter);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getAccepters(): Collection
    {
        return $this->accepters;
    }

    /**
     * @return Collection<int, Partager>
     */
    public function getPartagers(): Collection
    {
        return $this->partagers;
    }

    public function addPartager(Partager $partager): self
    {
        if (!$this->partagers->contains($partager)) {
            $this->partagers->add($partager);
            $partager->setUser($this);
        }

        return $this;
    }

    public function removePartager(Partager $partager): self
    {
        if ($this->partagers->removeElement($partager)) {
            // set the owning side to null (unless already changed)
            if ($partager->getUser() === $this) {
                $partager->setUser(null);
            }
        }

        return $this;
    }
}
