<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TecnicosRepository")
 */
class Tecnicos
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $cpf;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nome_completo;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dt_nasc;

    /**
     * @ORM\Column(type="float")
     */
    private $valor_hora;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Os", mappedBy="Tecnico")
     */
    private $os;

    public function __construct()
    {
        $this->os = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getNomeCompleto(): ?string
    {
        return $this->nome_completo;
    }

    public function setNomeCompleto(string $nome_completo): self
    {
        $this->nome_completo = $nome_completo;

        return $this;
    }

    public function getDtNasc(): ?\DateTimeInterface
    {
        return $this->dt_nasc;
    }

    public function setDtNasc(\DateTimeInterface $dt_nasc): self
    {
        $this->dt_nasc = $dt_nasc;

        return $this;
    }

    public function getValorHora(): ?float
    {
        return $this->valor_hora;
    }

    public function setValorHora(float $valor_hora): self
    {
        $this->valor_hora = $valor_hora;

        return $this;
    }

    /**
     * @return Collection|Os[]
     */
    public function getOs(): Collection
    {
        return $this->os;
    }

    public function addO(Os $o): self
    {
        if (!$this->os->contains($o)) {
            $this->os[] = $o;
            $o->setTecnico($this);
        }

        return $this;
    }

    public function removeO(Os $o): self
    {
        if ($this->os->contains($o)) {
            $this->os->removeElement($o);
            // set the owning side to null (unless already changed)
            if ($o->getTecnico() === $this) {
                $o->setTecnico(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->getNomeCompleto();
    }
}
