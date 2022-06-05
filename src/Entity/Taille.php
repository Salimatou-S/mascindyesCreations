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

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
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

    
}
