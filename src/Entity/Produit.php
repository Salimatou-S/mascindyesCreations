<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Gedmo\Mapping\Annotation as Gedmo;



#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    private $url_image;

    #[ORM\ManyToOne(targetEntity: Fournisseur::class, inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private $fournisseur;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\Column(type: 'boolean')]
    private $active;

    #[Gedmo\Timestampable(on:"update")]
    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $updatedAt;

    #[Gedmo\Timestampable(on:"create")]
    #[ORM\Column(type: 'datetime_immutable')]
    private $createdAt;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $note;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Stock::class)]
    private $stocks;

    #[ORM\Column(type: 'float')]
    private $prix;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Rapport::class)]
    private $rapports;

     /**
     * @gedmo\Slug(fields={"nom"})
     */
    #[ORM\Column(type: 'string', length: 50)]
    private $slug;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: Commentaire::class, orphanRemoval: true)]
    private $commentaires;

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
        $this->rapports = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrlImage(): ?string
    {
        return $this->url_image;
    }

    public function setUrlImage(string $url_image): self
    {
        $this->url_image = $url_image;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

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
            $stock->setProduit($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getProduit() === $this) {
                $stock->setProduit(null);
            }
        }

        return $this;
    }


       public function getPrix(): ?float
       {
           return $this->prix;
       }

       public function setPrix(float $prix): self
       {
           $this->prix = $prix;

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
               $rapport->setProduit($this);
           }

           return $this;
       }

       public function removeRapport(Rapport $rapport): self
       {
           if ($this->rapports->removeElement($rapport)) {
               // set the owning side to null (unless already changed)
               if ($rapport->getProduit() === $this) {
                   $rapport->setProduit(null);
               }
           }

           return $this;
       }

       public function getSlug(): ?string
       {
           return $this->slug;
       }

       public function setSlug(string $slug): self
       {
           $this->slug = $slug;

           return $this;
       }

      

       /**
        * @return Collection<int, Commentaire>
        */
       public function getCommentaires(): Collection
       {
           return $this->commentaires;
       }

       public function addCommentaire(Commentaire $commentaire): self
       {
           if (!$this->commentaires->contains($commentaire)) {
               $this->commentaires[] = $commentaire;
               $commentaire->setProduit($this);
           }

           return $this;
       }

       public function removeCommentaire(Commentaire $commentaire): self
       {
           if ($this->commentaires->removeElement($commentaire)) {
               // set the owning side to null (unless already changed)
               if ($commentaire->getProduit() === $this) {
                   $commentaire->setProduit(null);
               }
           }

           return $this;
       } 
}
