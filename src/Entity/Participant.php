<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="participant")
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantRepository")
 */
class Participant implements UserInterface
{

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue()
     */
    private $idParticipant;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Regex("/^[0-9]*$/")
     */
    private $telephone;

    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=false, unique=true)
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas un email valide."
     * )
     */
    private $mail;

    /**
     * @ORM\Column(name="motPasse", type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $administrateur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sortie", mappedBy="organisateur")
     */
    private $listeSortiesOrga;

    public function __construct()
    {
        $this->listeSortiesOrga = new ArrayCollection();
    }

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Sortie", mappedBy="listeParticipants")
     */

    private $listeSortiesDuParticipant;

    /**
     * @ORM\ManyToONe(targetEntity="App\Entity\Campus", inversedBy="listeParticipants")
     * @ORM\JoinColumn(referencedColumnName="id_campus")
     */
    private $campus;

    /**
     * @return ArrayCollection
     */
    public function getListeSortiesOrga(): ArrayCollection
    {
        return $this->listeSortiesOrga;
    }

    /**
     * @param ArrayCollection $listeSortiesOrga
     */
    public function setListeSortiesOrga(ArrayCollection $listeSortiesOrga): void
    {
        $this->listeSortiesOrga = $listeSortiesOrga;
    }

    /**
     * @return mixed
     */
    public function getListeSortiesDuParticipant()
    {
        return $this->listeSortiesDuParticipant;
    }

    /**
     * @param mixed $listeSortiesDuParticipant
     */
    public function setListeSortiesDuParticipant($listeSortiesDuParticipant): void
    {
        $this->listeSortiesDuParticipant = $listeSortiesDuParticipant;
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
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail): void
    {
        $this->mail = $mail;
    }



    public function getIdParticipant(): ?int
    {
        return $this->idParticipant;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAdministrateur(): ?bool
    {
        return $this->administrateur;
    }

    public function setAdministrateur(bool $administrateur): self
    {
        $this->administrateur = $administrateur;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getRoles()
    {
        if ($this->getAdministrateur() == true)
              return ["ROLE_ADMIN"];
        else
            return ["ROLE_USER"];
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
    }
}
