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

    #[ORM\ManyToOne(inversedBy: 'statusSeries')]
    private ?User $user_episode = null;

    #[ORM\ManyToOne(inversedBy: 'stat_ep_series')]
    private ?Serie $stat_ep_serie = null;

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

    public function getUserEpisode(): ?User
    {
        return $this->user_episode;
    }

    public function setUserEpisode(?User $user_episode): self
    {
        $this->user_episode = $user_episode;

        return $this;
    }

    public function getStatEpSerie(): ?Serie
    {
        return $this->stat_ep_serie;
    }

    public function setStatEpSerie(?Serie $stat_ep_serie): self
    {
        $this->stat_ep_serie = $stat_ep_serie;

        return $this;
    }
}
