<?php

namespace App\Entity;

use App\Repository\TailleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TailleRepository::class)]
class Taille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private $taille;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: Stock::class)]
    private $stocks;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: Rapport::class)]
    private $rapports;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
        $this->rapports = new ArrayCollection();
    }

    

    public function __toString()
    {
       return $this->taille;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(?string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * @return Collection<int, Stock>
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setTaille($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getTaille() === $this) {
                $stock->setTaille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rapport>
     */
    public function getRapports(): Collection
    {
        return $this->rapports;
    }

    public function addRapport(Rapport $rapport): self
    {
        if (!$this->rapports->contains($rapport)) {
            $this->rapports[] = $rapport;
            $rapport->setTaille($this);
        }

        return $this;
    }

    public function removeRapport(Rapport $rapport): self
    {
        if ($this->rapports->removeElement($rapport)) {
            // set the owning side to null (unless already changed)
            if ($rapport->getTaille() === $this) {
                $rapport->setTaille(null);
            }
        }

        return $this;
    }

    
}
