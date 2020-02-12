<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TallerRepository")
 */
class Taller
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulota;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $liketa;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoriataller")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoriataller_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulota(): ?string
    {
        return $this->titulota;
    }

    public function setTitulota(string $titulota): self
    {
        $this->titulota = $titulota;

        return $this;
    }

    public function getLiketa(): ?int
    {
        return $this->liketa;
    }

    public function setLiketa(?int $liketa): self
    {

        if($liketa <= 0){
            $this->liketa = 0;
        }
        else{
            $this->liketa = $liketa;
        }

        return $this;
    }

    public function getCategoriatallerId(): ?Categoriataller
    {
        return $this->categoriataller_id;
    }

    public function setCategoriatallerId(?Categoriataller $categoriataller_id): self
    {
        $this->categoriataller_id = $categoriataller_id;

        return $this;
    }
}
