<?php

namespace App\Entity;

use App\Repository\StatusUserRepository;
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
}
