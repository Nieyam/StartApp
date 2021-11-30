<?php

namespace App\Entity;

use App\Repository\CategorienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorienRepository::class)
 */
class Categorien
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
    private $gerecht;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $dranken;

    /**
     * @ORM\ManyToOne(targetEntity=SubCategorie::class, inversedBy="Categorien")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subCategorie;

    /**
     * @ORM\OneToMany(targetEntity=Menu::class, mappedBy="Categorien")
     */
    private $menus;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGerecht(): ?string
    {
        return $this->gerecht;
    }

    public function setGerecht(string $gerecht): self
    {
        $this->gerecht = $gerecht;

        return $this;
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

    public function getSubCategorie(): ?SubCategorie
    {
        return $this->subCategorie;
    }

    public function setSubCategorie(?SubCategorie $subCategorie): self
    {
        $this->subCategorie = $subCategorie;

        return $this;
    }

    /**
     * @return Collection|Menu[]
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->setCategorien($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            // set the owning side to null (unless already changed)
            if ($menu->getCategorien() === $this) {
                $menu->setCategorien(null);
            }
        }

        return $this;
    }
}
