<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EtudiantRepository;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    /**
     * @Assert\NotBlank
     */
    private $nom;

    #[ORM\Column(type: 'integer')]
    /**
     * @Assert\NotBlank
     */
    private $cne;

    #[ORM\Column(type: 'integer')]
    /**
     * @Assert\NotBlank
     */
    private $telephone;

    #[ORM\Column(type: 'string', length: 255)]
    /**
     * @Assert\NotBlank
     */
    private $email;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: Note::class)]
    private $notes;

    #[ORM\ManyToOne(targetEntity: Groupe::class, inversedBy: 'etudiants')]
    #[ORM\JoinColumn(nullable: true)]
    private $groupe;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCne(): ?int
    {
        return $this->cne;
    }

    public function setCne(int $cne): self
    {
        $this->cne = $cne;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

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

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setEtudiant($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getEtudiant() === $this) {
                $note->setEtudiant(null);
            }
        }

        return $this;
    }
    // Register Magic Method to Print the name of the State e.g California
    public function __toString()
    {
        return $this->nom;
    }

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }
}
