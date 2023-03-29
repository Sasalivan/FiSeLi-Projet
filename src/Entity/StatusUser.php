<?php

namespace App\Entity;

use App\Repository\StatusUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusUserRepository::class)]
class StatusUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_status = null;

    #[ORM\ManyToMany(targetEntity: Serie::class, mappedBy: 'stat_serie_user')]
    private Collection $stat_serie;

    public function __construct()
    {
        $this->stat_serie = new ArrayCollection();
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
    public function getStatSerie(): Collection
    {
        return $this->stat_serie;
    }

    public function addStatSerie(Serie $statSerie): self
    {
        if (!$this->stat_serie->contains($statSerie)) {
            $this->stat_serie->add($statSerie);
            $statSerie->addStatSerieUser($this);
        }

        return $this;
    }

    public function removeStatSerie(Serie $statSerie): self
    {
        if ($this->stat_serie->removeElement($statSerie)) {
            $statSerie->removeStatSerieUser($this);
        }

        return $this;
    }
}
