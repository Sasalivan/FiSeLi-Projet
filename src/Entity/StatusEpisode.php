<?php

namespace App\Entity;

use App\Repository\StatusEpisodeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusEpisodeRepository::class)]
class StatusEpisode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbEpisodeUser = null;

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
}
