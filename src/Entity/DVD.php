<?php

namespace App\Entity;

use App\Repository\DVDRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DVDRepository::class)
 */
class DVD
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrcopie;
  /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\Column(type="date")
     */
    private $dateajout;

/**
     * @ORM\ManyToOne(targetEntity="App\Entity\Film", inversedBy="dvd")
     */
    private $film;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Emprunt", mappedBy="dvd",cascade={"persist","remove"}, orphanRemoval=true)
     */
    private $emprunts;
 public function __construct()
                                  {
                                          $this->dateajout  = new \DateTime('now');
                                          $this->emprunts = new ArrayCollection();

                                  }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrcopie(): ?int
    {
        return $this->nbrcopie;
    }

    public function setNbrcopie(int $nbrcopie): self
    {
        $this->nbrcopie = $nbrcopie;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDateajout(): ?\DateTimeInterface
    {
        return $this->dateajout;
    }

    public function setDateajout(\DateTimeInterface $dateajout): self
    {
        $this->dateajout = $dateajout;

        return $this;
    }

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): self
    {
        $this->film = $film;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection|Emprunt[]
     */
    public function getEmprunts(): Collection
    {
        return $this->emprunts;
    }

    public function addEmprunt(Emprunt $emprunt): self
    {
        if (!$this->emprunts->contains($emprunt)) {
            $this->emprunts[] = $emprunt;
            $emprunt->setDvd($this);
        }

        return $this;
    }

    public function removeEmprunt(Emprunt $emprunt): self
    {
        if ($this->emprunts->removeElement($emprunt)) {
            // set the owning side to null (unless already changed)
            if ($emprunt->getDvd() === $this) {
                $emprunt->setDvd(null);
            }
        }

        return $this;
    }
    public function __toString()
{
return $this->film;
}

    public function getPrixemprunte(): ?float
    {
        return $this->prixemprunte;
    }

    public function setPrixemprunte(float $prixemprunte): self
    {
        $this->prixemprunte = $prixemprunte;

        return $this;
    }
}
