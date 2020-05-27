<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Date;

class FindSortie
{
    private $name;

    private $idSortie;

    private $dateHeureDebut;

    private $duree;

    private $dateLimiteInscription;

    private $premiereDate;

    private $deuxiemeDate;

    private $nbInscriptionMax;

    private $infosSortie;

    private $etat;

    private $lieu;

    private $campus;

    private $organisateur = false;

    private $listeParticipants;

    private $inscrit = false;

    private $pasinscrit = false;

    private $passees = false;

    public function __construct()
    {
        $this->listeParticipants = new ArrayCollection();

    }

    /**
     * @return mixed
     */
    public function getPremiereDate()
    {
        return $this->premiereDate;
    }

    /**
     * @param mixed $premiereDate
     */
    public function setPremiereDate($premiereDate): void
    {
        $this->premiereDate = $premiereDate;
    }

    /**
     * @return mixed
     */
    public function getDeuxiemeDate()
    {
        return $this->deuxiemeDate;
    }

    /**
     * @param mixed $deuxiemeDate
     */
    public function setDeuxiemeDate($deuxiemeDate): void
    {
        $this->deuxiemeDate = $deuxiemeDate;
    }



    /**
     * @return bool
     */
    public function isInscrit(): bool
    {
        return $this->inscrit;
    }

    /**
     * @param bool $inscrit
     */
    public function setInscrit(bool $inscrit): void
    {
        $this->inscrit = $inscrit;
    }

    /**
     * @return bool
     */
    public function isPasinscrit(): bool
    {
        return $this->pasinscrit;
    }

    /**
     * @param bool $pasinscrit
     */
    public function setPasinscrit(bool $pasinscrit): void
    {
        $this->pasinscrit = $pasinscrit;
    }

    /**
     * @return bool
     */
    public function isPassees(): bool
    {
        return $this->passees;
    }

    /**
     * @param bool $passees
     */
    public function setPassees(bool $passees): void
    {
        $this->passees = $passees;
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
     */
    public function setName($name): void
    {
        $this->name = $name;
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
     */
    public function setIdSortie($idSortie): void
    {
        $this->idSortie = $idSortie;
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
     */
    public function setDateHeureDebut($dateHeureDebut): void
    {
        $this->dateHeureDebut = $dateHeureDebut;
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
    public function getDateLimiteInscription()
    {
        return $this->dateLimiteInscription;
    }

    /**
     * @param mixed $dateLimiteInscription
     */
    public function setDateLimiteInscription($dateLimiteInscription): void
    {
        $this->dateLimiteInscription = $dateLimiteInscription;
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
     */
    public function setNbInscriptionMax($nbInscriptionMax): void
    {
        $this->nbInscriptionMax = $nbInscriptionMax;
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
     */
    public function setInfosSortie($infosSortie): void
    {
        $this->infosSortie = $infosSortie;
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
     */
    public function setEtat($etat): void
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     */
    public function setLieu($lieu): void
    {
        $this->lieu = $lieu;
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



}












