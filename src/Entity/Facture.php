<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $reference;



   /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="editeurs")
     */
    private $editeur;

	/**
     * @ORM\ManyToOne(targetEntity="App\Entity\Emprunt", inversedBy="facture")
     */
    private $emprunt;



    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

public function __construct()
    {
      $this->date  = new \DateTime('now');
      $this->emprunt = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }




    public function getEditeur(): ?User
    {
        return $this->editeur;
    }

    public function setEditeur(?User $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }



    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEmprunt(): ?Emprunt
    {
        return $this->emprunt;
    }

    public function setEmprunt(?Emprunt $emprunt): self
    {
        $this->emprunt = $emprunt;

        return $this;
    }




}
