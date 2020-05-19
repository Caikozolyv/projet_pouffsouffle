<?php

namespace App\Entity;

use App\Repository\SortieRepository;
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
    //test push
    private $idSortie;

    private $name;
    private $dateHeureDebut;
    private $durée;
    private $dateLimiteInscription;
    private $nbInscriptionMax;
    private $infosSortie;
    private $etat;

    public function getIdSortie()
    {
        return $this->id;
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
