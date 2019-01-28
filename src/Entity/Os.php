<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OsRepository")
 */
class Os
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=13)
     */
    private $Sequence;

    /**
     * @ORM\Column(type="float")
     */
    private $desconto;

    /**
     * @ORM\Column(type="float")
     */
    private $valor_total;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data_servico;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tecnicos", inversedBy="Os")
     * @ORM\JoinColumn(nullable=false, name="tecnico_id", referencedColumnName="id")
     */
    private $tecnico;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ferramentas", mappedBy="Os")
     */
    private $ferramenta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Servicos", inversedBy="Os")
     * @ORM\JoinColumn(nullable=false, name="servico_id", referencedColumnName="id")
     */
    private $servico;

    public function __construct()
    {
        $this->ferramenta = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSequence(): ?string
    {
        return $this->Sequence;
    }

    public function setSequence(string $Sequence): self
    {
        $this->Sequence = $Sequence;

        return $this;
    }

    public function getDesconto(): ?float
    {
        return $this->desconto;
    }

    public function setDesconto(float $desconto): self
    {
        $this->desconto = $desconto;

        return $this;
    }

    public function getValorTotal(): ?float
    {
        return $this->valor_total;
    }

    public function setValorTotal(float $valor_total): self
    {
        $this->valor_total = $valor_total;

        return $this;
    }

    public function getDataServico(): ?\DateTimeInterface
    {
        return $this->data_servico;
    }

    public function setDataServico(\DateTimeInterface $data_servico): self
    {
        $this->data_servico = $data_servico;

        return $this;
    }

    public function getTecnico(): ?Tecnicos
    {
        return $this->tecnico;
    }

    public function setTecnico(?Tecnicos $tecnico): self
    {
        $this->tecnico = $tecnico;

        return $this;
    }

    /**
     * @return Collection|ferramentas[]
     */
    public function getFerramenta(): Collection
    {
        return $this->ferramenta;
    }

    public function addFerramentum(Ferramentas $ferramentum): self
    {
        if (!$this->ferramenta->contains($ferramentum)) {
            $this->ferramenta[] = $ferramentum;
            $ferramentum->setOs($this);
        }

        return $this;
    }

    public function removeFerramentum(ferramentas $ferramentum): self
    {
        if ($this->ferramenta->contains($ferramentum)) {
            $this->ferramenta->removeElement($ferramentum);
            // set the owning side to null (unless already changed)
            if ($ferramentum->getOs() === $this) {
                $ferramentum->setOs(null);
            }
        }

        return $this;
    }

    public function getServico(): ?Servicos
    {
        return $this->servico;
    }

    public function setServico(?Servicos $servico): self
    {
        $this->servico = $servico;

        return $this;
    }
}
