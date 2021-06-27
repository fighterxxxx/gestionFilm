<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
 */
class Film
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $realisateur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $acteur;

    /**
     * @ORM\Column(type="date")
     */
    private $dateajout;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $langue;

    /**
     * @ORM\Column(type="date")
     */
    private $anneesortie;

/**
     * @ORM\OneToMany(targetEntity="App\Entity\DVD", mappedBy="film",cascade={"persist","remove"}, orphanRemoval=true)
     */
    private $dvd;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="film")
     */
    private $categorie;
  public function __construct()
    {
      $this->annesortie  = new \DateTime('now');
            $this->dateajout  = new \DateTime('now');
            $this->dvd = new ArrayCollection();
            $this->emprunts = new ArrayCollection();

    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getRealisateur(): ?string
    {
        return $this->realisateur;
    }

    public function setRealisateur(string $realisateur): self
    {
        $this->realisateur = $realisateur;

        return $this;
    }

    public function getActeur(): ?string
    {
        return $this->acteur;
    }

    public function setActeur(string $acteur): self
    {
        $this->acteur = $acteur;

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


    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getAnneesortie(): ?\DateTimeInterface
    {
        return $this->anneesortie;
    }

    public function setAnneesortie(\DateTimeInterface $anneesortie): self
    {
        $this->anneesortie = $anneesortie;

        return $this;
    }

    /**
     * @return Collection|DVD[]
     */
    public function getDvd(): Collection
    {
        return $this->dvd;
    }

    public function addDvd(DVD $dvd): self
    {
        if (!$this->dvd->contains($dvd)) {
            $this->dvd[] = $dvd;
            $dvd->setFilm($this);
        }

        return $this;
    }

    public function removeDvd(DVD $dvd): self
    {
        if ($this->dvd->removeElement($dvd)) {
            // set the owning side to null (unless already changed)
            if ($dvd->getFilm() === $this) {
                $dvd->setFilm(null);
            }
        }

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
            $emprunt->setFilm($this);
        }

        return $this;
    }

    public function removeEmprunt(Emprunt $emprunt): self
    {
        if ($this->emprunts->removeElement($emprunt)) {
            // set the owning side to null (unless already changed)
            if ($emprunt->getFilm() === $this) {
                $emprunt->setFilm(null);
            }
        }

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

}
