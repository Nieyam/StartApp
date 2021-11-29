<?php

namespace App\Entity;

use App\Repository\SubCategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubCategorieRepository::class)
 */
class SubCategorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $dranken;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $warme_dranken;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $hapjes;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $voorgerecht;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $hoofdgerecht;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nagerecht;

    /**
     * @ORM\OneToMany(targetEntity=categorien::class, mappedBy="subCategorie")
     */
    private $categorien;

    public function __construct()
    {
        $this->categorien = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDranken(): ?string
    {
        return $this->dranken;
    }

    public function setDranken(string $dranken): self
    {
        $this->dranken = $dranken;

        return $this;
    }

    public function getWarmeDranken(): ?string
    {
        return $this->warme_dranken;
    }

    public function setWarmeDranken(string $warme_dranken): self
    {
        $this->warme_dranken = $warme_dranken;

        return $this;
    }

    public function getHapjes(): ?string
    {
        return $this->hapjes;
    }

    public function setHapjes(string $hapjes): self
    {
        $this->hapjes = $hapjes;

        return $this;
    }

    public function getVoorgerecht(): ?string
    {
        return $this->voorgerecht;
    }

    public function setVoorgerecht(string $voorgerecht): self
    {
        $this->voorgerecht = $voorgerecht;

        return $this;
    }

    public function getHoofdgerecht(): ?string
    {
        return $this->hoofdgerecht;
    }

    public function setHoofdgerecht(string $hoofdgerecht): self
    {
        $this->hoofdgerecht = $hoofdgerecht;

        return $this;
    }

    public function getNagerecht(): ?string
    {
        return $this->nagerecht;
    }

    public function setNagerecht(string $nagerecht): self
    {
        $this->nagerecht = $nagerecht;

        return $this;
    }

    /**
     * @return Collection|categorien[]
     */
    public function getCategorien(): Collection
    {
        return $this->categorien;
    }

    public function addCategorien(categorien $categorien): self
    {
        if (!$this->categorien->contains($categorien)) {
            $this->categorien[] = $categorien;
            $categorien->setSubCategorie($this);
        }

        return $this;
    }

    public function removeCategorien(categorien $categorien): self
    {
        if ($this->categorien->removeElement($categorien)) {
            // set the owning side to null (unless already changed)
            if ($categorien->getSubCategorie() === $this) {
                $categorien->setSubCategorie(null);
            }
        }

        return $this;
    }
}
