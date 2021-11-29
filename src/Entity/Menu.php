<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MenuRepository::class)
 */
class Menu
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
    private $naam;

    /**
     * @ORM\Column(type="float")
     */
    private $prijs;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $omschrijving;

    /**
     * @ORM\OneToMany(targetEntity=Bestellingen::class, mappedBy="menu")
     */
    private $bestellingens;

    /**
     * @ORM\ManyToOne(targetEntity=categorien::class, inversedBy="menus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorien;

    public function __construct()
    {
        $this->bestellingens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getPrijs(): ?float
    {
        return $this->prijs;
    }

    public function setPrijs(float $prijs): self
    {
        $this->prijs = $prijs;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    /**
     * @return Collection|Bestellingen[]
     */
    public function getBestellingens(): Collection
    {
        return $this->bestellingens;
    }

    public function addBestellingen(Bestellingen $bestellingen): self
    {
        if (!$this->bestellingens->contains($bestellingen)) {
            $this->bestellingens[] = $bestellingen;
            $bestellingen->setMenu($this);
        }

        return $this;
    }

    public function removeBestellingen(Bestellingen $bestellingen): self
    {
        if ($this->bestellingens->removeElement($bestellingen)) {
            // set the owning side to null (unless already changed)
            if ($bestellingen->getMenu() === $this) {
                $bestellingen->setMenu(null);
            }
        }

        return $this;
    }

    public function getCategorien(): ?categorien
    {
        return $this->categorien;
    }

    public function setCategorien(?categorien $categorien): self
    {
        $this->categorien = $categorien;

        return $this;
    }
}
