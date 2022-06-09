<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $reference_commande;

    #[ORM\Column(type: 'float')]
    private $montant_TTc;

    #[ORM\Column(type: 'datetime')]
    private $date_creation;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date_livraison;

    #[ORM\Column(type: 'float', nullable: true)]
    private $frais_livraison;

    #[ORM\Column(type: 'float')]
    private $montant_total_ttc;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'commandes')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Rapport::class)]
    private $rapports;

    public function __construct()
    {
        $this->rapports = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReferenceCommande(): ?string
    {
        return $this->reference_commande;
    }

    public function setReferenceCommande(string $reference_commande): self
    {
        $this->reference_commande = $reference_commande;

        return $this;
    }

    public function getMontantTTc(): ?float
    {
        return $this->montant_TTc;
    }

    public function setMontantTTc(float $montant_TTc): self
    {
        $this->montant_TTc = $montant_TTc;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->date_livraison;
    }

    public function setDateLivraison(?\DateTimeInterface $date_livraison): self
    {
        $this->date_livraison = $date_livraison;

        return $this;
    }

    public function getFraisLivraison(): ?float
    {
        return $this->frais_livraison;
    }

    public function setFraisLivraison(?float $frais_livraison): self
    {
        $this->frais_livraison = $frais_livraison;

        return $this;
    }

    public function getMontantTotalTtc(): ?float
    {
        return $this->montant_total_ttc;
    }

    public function setMontantTotalTtc(float $montant_total_ttc): self
    {
        $this->montant_total_ttc = $montant_total_ttc;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
            $rapport->setCommande($this);
        }

        return $this;
    }

    public function removeRapport(Rapport $rapport): self
    {
        if ($this->rapports->removeElement($rapport)) {
            // set the owning side to null (unless already changed)
            if ($rapport->getCommande() === $this) {
                $rapport->setCommande(null);
            }
        }

        return $this;
    }
}
