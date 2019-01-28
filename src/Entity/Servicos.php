<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ServicosRepository")
 */
class Servicos
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\column(type="string")
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $descricao;

    /**
     * @ORM\Column(type="integer")
     */
    private $tempo_medio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getTempoMedio(): ?int
    {
        return $this->tempo_medio;
    }

    public function setTempoMedio(int $tempo_medio): self
    {
        $this->tempo_medio = $tempo_medio;

        return $this;
    }

    public function __toString() {
        return $this->getDescricao();
    }
}
