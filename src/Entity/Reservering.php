<?php

namespace App\Entity;

use App\Repository\ReserveringRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReserveringRepository::class)
 */
class Reservering
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datum;

    /**
     * @ORM\Column(type="time")
     */
    private $tijd;

    /**
     * @ORM\Column(type="integer")
     */
    private $tafel;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $naam;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $telefoon;

    /**
     * @ORM\OneToMany(targetEntity=Bestellingen::class, mappedBy="reservering")
     */
    private $bestellingens;

    public function __construct()
    {
        $this->bestellingens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getTijd(): ?\DateTimeInterface
    {
        return $this->tijd;
    }

    public function setTijd(\DateTimeInterface $tijd): self
    {
        $this->tijd = $tijd;

        return $this;
    }

    public function getTafel(): ?int
    {
        return $this->tafel;
    }

    public function setTafel(int $tafel): self
    {
        $this->tafel = $tafel;

        return $this;
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

    public function getTelefoon(): ?string
    {
        return $this->telefoon;
    }

    public function setTelefoon(string $telefoon): self
    {
        $this->telefoon = $telefoon;

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
            $bestellingen->setReservering($this);
        }

        return $this;
    }

    public function removeBestellingen(Bestellingen $bestellingen): self
    {
        if ($this->bestellingens->removeElement($bestellingen)) {
            // set the owning side to null (unless already changed)
            if ($bestellingen->getReservering() === $this) {
                $bestellingen->setReservering(null);
            }
        }

        return $this;
    }
}
