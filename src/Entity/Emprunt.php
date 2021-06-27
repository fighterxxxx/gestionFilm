<?php

namespace App\Entity;

use App\Repository\EmpruntRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmpruntRepository::class)
 */
class Emprunt
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datedebut;

    /**
     * @ORM\Column(type="date")
     */
    private $datefin;

    /**
     * @ORM\Column(type="date")
     */
    private $daterendu;
  /**
     * @ORM\Column(type="date")
     */
    private $dateajout;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;
/**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;
     /**
     * @ORM\ManyToOne(targetEntity="DVD", inversedBy="emprunts")
     */

    private $dvd;
 /**
          * @ORM\ManyToOne(targetEntity="User", inversedBy="emprunts")

     */
    private $user;
     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Facture", mappedBy="emprunt",cascade={"persist","remove"}, orphanRemoval=true)
     */
    private $facture;
    public function __construct()
    {

        //$this->dateemprunt = new \Datetime();
        $this->dateajout= new \DateTime();

        $this->datedebut= new \DateTime();
        $this->datefin= new \DateTime();
        $this->daterendu= new \DateTime();
        //$this->daterendu->modify('+30 day');
        $this->facture = new ArrayCollection();


    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }




    public function getDaterendu(): ?\DateTimeInterface
    {
        return $this->daterendu;
    }

    public function setDaterendu(\DateTimeInterface $daterendu): self
    {
        $this->daterendu = $daterendu;

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

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDvd(): ?DVD
    {
        return $this->dvd;
    }

    public function setDvd(?DVD $dvd): self
    {
        $this->dvd = $dvd;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFacture(): Collection
    {
        return $this->facture;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->facture->contains($facture)) {
            $this->facture[] = $facture;
            $facture->setEmprunt($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->facture->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getEmprunt() === $this) {
                $facture->setEmprunt(null);
            }
        }

        return $this;
    }
}
