<?php

namespace App\Entity;

use App\Repository\BestellingenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BestellingenRepository::class)
 */
class Bestellingen
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=reservering::class, inversedBy="bestellingens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reservering;

    /**
     * @ORM\ManyToOne(targetEntity=menu::class, inversedBy="bestellingens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $menu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReservering(): ?reservering
    {
        return $this->reservering;
    }

    public function setReservering(?reservering $reservering): self
    {
        $this->reservering = $reservering;

        return $this;
    }

    public function getMenu(): ?menu
    {
        return $this->menu;
    }

    public function setMenu(?menu $menu): self
    {
        $this->menu = $menu;

        return $this;
    }
}
