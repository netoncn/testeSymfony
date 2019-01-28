<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FerramentasRepository")
 */
class Ferramentas
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $cod_ferramenta;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nome_ferramenta;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $marca_ferramenta;

    /**
     * @ORM\Column(type="float")
     */
    private $aluguel_hora;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Os", inversedBy="Ferramenta")
     */
    private $os;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodFerramenta(): ?int
    {
        return $this->cod_ferramenta;
    }

    public function setCodFerramenta(int $cod_ferramenta): self
    {
        $this->cod_ferramenta = $cod_ferramenta;

        return $this;
    }

    public function getNomeFerramenta(): ?string
    {
        return $this->nome_ferramenta;
    }

    public function setNomeFerramenta(string $nome_ferramenta): self
    {
        $this->nome_ferramenta = $nome_ferramenta;

        return $this;
    }

    public function getMarcaFerramenta(): ?string
    {
        return $this->marca_ferramenta;
    }

    public function setMarcaFerramenta(string $marca_ferramenta): self
    {
        $this->marca_ferramenta = $marca_ferramenta;

        return $this;
    }

    public function getAluguelHora(): ?float
    {
        return $this->aluguel_hora;
    }

    public function setAluguelHora(float $aluguel_hora): self
    {
        $this->aluguel_hora = $aluguel_hora;

        return $this;
    }

    public function getOs(): ?Os
    {
        return $this->os;
    }

    public function setOs(?Os $os): self
    {
        $this->os = $os;

        return $this;
    }

    public function __toString() {
        return $this->getNomeFerramenta();
    }
}
