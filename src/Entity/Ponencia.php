<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PonenciaRepository")
 */
class Ponencia
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
    private $titulopo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likepo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoriaponencia")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categoriaponencia_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulopo(): ?string
    {
        return $this->titulopo;
    }

    public function setTitulopo(string $titulopo): self
    {
        $this->titulopo = $titulopo;

        return $this;
    }

    public function getLikepo(): ?int
    {
        return $this->likepo;
    }

    public function setLikepo(?int $likepo): self
    {

        if($likepo <= 0){
            $this->likepo = 0;
        }
        else{
            $this->likepo = $likepo;
        }
        

        return $this;
    }

    public function getCategoriaponenciaId(): ?Categoriaponencia
    {
        return $this->categoriaponencia_id;
    }

    public function setCategoriaponenciaId(?Categoriaponencia $categoriaponencia_id): self
    {
        $this->categoriaponencia_id = $categoriaponencia_id;

        return $this;
    }
}
