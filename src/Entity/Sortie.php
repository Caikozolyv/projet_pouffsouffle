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
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieu", inversedBy="listeSorties")
     * @ORM\JoinColumn(referencedColumnName="id_lieu")
     */
    private $lieu;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campus", inversedBy="listeSorties")
     * @ORM\JoinColumn(referencedColumnName="id_campus")
     */
    private $campus;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participant", inversedBy="listeSortiesOrga")
     * @ORM\JoinColumn(referencedColumnName="id_participant")
     */
    private $organisateur;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Participant", inversedBy="listeSortiesDuParticipant")
     * @ORM\JoinTable(name="sorties_participants",
     *     joinColumns={@ORM\JoinColumn(referencedColumnName="id_sortie")},
     *     inverseJoinColumns={@ORM\JoinColumn(referencedColumnName="id_participant")})
     */
    private $listeParticipants;

    public function __construct()
    {
        $this->listeParticipants = new ArrayCollection();

    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->listeParticipants->contains($participant)) {
           $this->listeParticipants[] =$participant;
        }
        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->listeParticipants->contains($participant)) {
            $this->listeParticipants->removeElement($participant);
        }
        return $this;
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



    /**
     * @return mixed
     */
    public function getIdSortie()
    {
        return $this->idSortie;
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
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     * @return Sortie
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
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
