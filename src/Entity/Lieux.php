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
     * @var string
     */
    private $nomLieu;


    /**
     * @var string
     */
    private $rue;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

}
