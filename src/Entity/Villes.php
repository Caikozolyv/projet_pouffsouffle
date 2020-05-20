<?php

namespace App\Entity;

use App\Repository\VillesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VillesRepository::class)
 */
class Villes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomVille;


    /**
     * @ORM\Column(type="string", length=50)
     */
    private $codePostal;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Lieu", mappedBy="ville", cascade={"remove"})
     */
    private $lieux;

    public function __construct()
    {
        $this->lieux = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getNomVille()
    {
        return $this->nomVille;
    }

    /**
     * @param mixed $nomVille
     */
    public function setNomVille($nomVille): void
    {
        $this->nomVille = $nomVille;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * @param mixed $codePostal
     */
    public function setCodePostal($codePostal): void
    {
        $this->codePostal = $codePostal;
    }

    /**
     * @return ArrayCollection
     */
    public function getLieux(): ArrayCollection
    {
        return $this->lieux;
    }

    /**
     * @param ArrayCollection $lieux
     */
    public function setLieux(ArrayCollection $lieux): void
    {
        $this->lieux = $lieux;
    }


}
