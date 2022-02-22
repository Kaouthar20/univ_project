<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    // #[ORM\JoinColumn(nullable: false)]
    private $username;

    #[ORM\Column(type: 'string', length: 255)]

    private $email;

    #[ORM\Column(type: 'string', length: 191)]
    private $password;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\OneToOne(mappedBy: 'user', targetEntity: Professeur::class, cascade: ['persist', 'remove'])]
    private $professeur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }
    public function getSalt(): ?string
    {
        return null;
    }
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;



    }
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(Professeur $professeur): self
    {
        // set the owning side of the relation if necessary
        if ($professeur->getUser() !== $this) {
            $professeur->setUser($this);
        }

        $this->professeur = $professeur;

        return $this;
    }
}
