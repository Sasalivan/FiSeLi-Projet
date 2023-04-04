<?php

namespace App\Entity;

use App\Repository\StatusSerieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusSerieRepository::class)]
class StatusSerie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbEpisodeUser = null;

    #[ORM\ManyToOne(inversedBy: 'statuses')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'statuses')]
    private ?Serie $serie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomStatus = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbEpisodeUser(): ?int
    {
        return $this->nbEpisodeUser;
    }

    public function setNbEpisodeUser(?int $nbEpisodeUser): self
    {
        $this->nbEpisodeUser = $nbEpisodeUser;

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

    public function getSerie(): ?Serie
    {
        return $this->serie;
    }

    public function setSerie(?Serie $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getNomStatus(): ?string
    {
        return $this->nomStatus;
    }

    public function setNomStatus(?string $nomStatus): self
    {
        $this->nomStatus = $nomStatus;

        return $this;
    }
}
