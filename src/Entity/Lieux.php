<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LieuxRepository::class)
 */
class Lieux
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $idLieux;

    /**
     * @ORM\Column(name="nom_lieu", type="string", length=50)
     */
    private $nomLieu;


    /**
     * @ORM\Column(name="rue", type="string", length=50)
     */
    private $rue;


    /**
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;


    /**
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Villes", inversedBy="lieux")
     */
    private $ville;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sortie", mappedBy="lieux", cascade={"remove"})
     */
    private $listeSorties;

    public function __construct()
    {
        $this->listeSorties = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getIdLieux()
    {
        return $this->idLieux;
    }

    /**
     * @return mixed
     */
    public function getNomLieu()
    {
        return $this->nomLieu;
    }

    /**
     * @param mixed $nomLieu
     */
    public function setNomLieu($nomLieu): void
    {
        $this->nomLieu = $nomLieu;
    }

    /**
     * @return mixed
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * @param mixed $rue
     */
    public function setRue($rue): void
    {
        $this->rue = $rue;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville): void
    {
        $this->ville = $ville;
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
}
