<?php

namespace App\Entity;

use App\Repository\LieuxRepository;
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
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomLieu;


    /**
     * @ORM\Column(type="string", length=50)
     */
    private $rue;


    /**
     * @ORM\Column(type="float")
     */
    private $latitude;


    /**
     * @ORM\Column(type="float")
     */
    private $longitude;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Villes", inversedBy="lieux")
     */
    private $ville;


}
