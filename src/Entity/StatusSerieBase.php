<?php

namespace App\Entity;

use App\Repository\StatusSerieBaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusSerieBaseRepository::class)]
class StatusSerieBase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_status = null;

    #[ORM\OneToMany(mappedBy: 'status_serie_base', targetEntity: Serie::class)]
    private Collection $statusSerie;

    public function __construct()
    {
        $this->statusSerie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStatus(): ?string
    {
        return $this->nom_status;
    }

    public function setNomStatus(string $nom_status): self
    {
        $this->nom_status = $nom_status;

        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getStatusSerie(): Collection
    {
        return $this->statusSerie;
    }

    public function addStatusSerie(Serie $statusSerie): self
    {
        if (!$this->statusSerie->contains($statusSerie)) {
            $this->statusSerie->add($statusSerie);
            $statusSerie->setStatusSerieBase($this);
        }

        return $this;
    }

    public function removeStatusSerie(Serie $statusSerie): self
    {
        if ($this->statusSerie->removeElement($statusSerie)) {
            // set the owning side to null (unless already changed)
            if ($statusSerie->getStatusSerieBase() === $this) {
                $statusSerie->setStatusSerieBase(null);
            }
        }

        return $this;
    }
}
