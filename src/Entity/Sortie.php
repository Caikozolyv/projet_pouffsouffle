<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SortieRepository::class)
 */
class Sortie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */

    private $idSortie;

    /**
     * @ORM\Column(type="string", length=150)
     */

    private $name;

    /**
     * @ORM\Column(type="date")
     */

    private $dateHeureDebut;

    /**
     * @ORM\Column(type="time", nullable=true)
     */

    private $duree;

    /**
     * @ORM\Column(type="date")
     */

    private $dateLimiteInscription;

    /**
     * @ORM\Column(type="integer")
     */

    private $nbInscriptionMax;

    /**
     * @ORM\Column(type="string", length=300)
     */

    private $infosSortie;

    /**
     * @ORM\Column(type="string", length=150)
     * @ORM\ManyToOne(targetEntity="App\Entity\Etat", inversedBy="listeSorties")
     */

    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieux", inversedBy="listeSorties")
     */
    private $lieux;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campus", inversedBy="campus")
     */
    private $campus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participant", inversedBy="listeSortiesOrga")
     */
    private $organisateur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Participant", mappedBy="listeSortiesDuParticipant")
     */
    private $listeParticipants;

    public function __construct()
    {
        $this->listeParticipants = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree): void
    {
        $this->duree = $duree;
    }

    /**
     * @return mixed
     */
    public function getLieux()
    {
        return $this->lieux;
    }

    /**
     * @param mixed $lieux
     */
    public function setLieux($lieux): void
    {
        $this->lieux = $lieux;
    }

    /**
     * @return mixed
     */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param mixed $campus
     */
    public function setCampus($campus): void
    {
        $this->campus = $campus;
    }

    /**
     * @return mixed
     */
    public function getOrganisateur()
    {
        return $this->organisateur;
    }

    /**
     * @param mixed $organisateur
     */
    public function setOrganisateur($organisateur): void
    {
        $this->organisateur = $organisateur;
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




    /**
     * @return mixed
     */
    public function getIdSortie()
    {
        return $this->idSortie;
    }

    /**
     * @param mixed $idSortie
     * @return Sortie
     */
    public function setIdSortie($idSortie)
    {
        $this->idSortie = $idSortie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Sortie
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateHeureDebut()
    {
        return $this->dateHeureDebut;
    }

    /**
     * @param mixed $dateHeureDebut
     * @return Sortie
     */
    public function setDateHeureDebut($dateHeureDebut)
    {
        $this->dateHeureDebut = $dateHeureDebut;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDurée()
    {
        return $this->durée;
    }

    /**
     * @param mixed $durée
     * @return Sortie
     */
    public function setDurée($durée)
    {
        $this->durée = $durée;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateLimiteInscription()
    {
        return $this->dateLimiteInscription;
    }

    /**
     * @param mixed $dateLimiteInscription
     * @return Sortie
     */
    public function setDateLimiteInscription($dateLimiteInscription)
    {
        $this->dateLimiteInscription = $dateLimiteInscription;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNbInscriptionMax()
    {
        return $this->nbInscriptionMax;
    }

    /**
     * @param mixed $nbInscriptionMax
     * @return Sortie
     */
    public function setNbInscriptionMax($nbInscriptionMax)
    {
        $this->nbInscriptionMax = $nbInscriptionMax;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInfosSortie()
    {
        return $this->infosSortie;
    }

    /**
     * @param mixed $infosSortie
     * @return Sortie
     */
    public function setInfosSortie($infosSortie)
    {
        $this->infosSortie = $infosSortie;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     * @return Sortie
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
        return $this;
    }








}
