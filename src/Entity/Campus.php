<?php

namespace App\Entity;

use App\Repository\CampusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CampusRepository::class)
 */
class Campus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idCampus;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sortie", mappedBy="campus")
     */
    private $listeSorties;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="campus")
     */
    private $listeParticipants;

    public function __construct()
    {
        $this->listeParticipants = new ArrayCollection();
        $this->listeSorties = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->idCampus;
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

    /**
     * @return ArrayCollection
     */
    public function getListeSorties(): ArrayCollection
    {
        return $this->listeSorties;
    }

    /**
     * @param ArrayCollection $listeSorties
     */
    public function setListeSorties(ArrayCollection $listeSorties): void
    {
        $this->listeSorties = $listeSorties;
    }

    /**
     * @return ArrayCollection
     */
    public function getListeParticipants(): ArrayCollection
    {
        return $this->listeParticipants;
    }

    /**
     * @param ArrayCollection $listeParticipants
     */
    public function setListeParticipants(ArrayCollection $listeParticipants): void
    {
        $this->listeParticipants = $listeParticipants;
    }



}
