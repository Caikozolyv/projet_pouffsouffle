<?php

namespace App\Entity;

use App\Repository\EtatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtatRepository::class)
 */
class Etat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */

    private $idEtat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sortie", mappedBy="sortie")
     */
    private $listeSorties;
    public function __construct()
    {
        $this->listeSorties = new ArrayCollection();
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


    public function getId(): ?int
    {
        return $this->idEtat;
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


}
