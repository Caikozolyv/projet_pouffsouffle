<?php

namespace App\Entity;

use App\Repository\VillesRepository;
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
     * @ORM\OneToMany(targetEntity="App\Entity\Lieux", mappedBy="ville", cascade={remove})
     */
    private $lieux ;

}
