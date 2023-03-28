<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titreOriginal = null;

    #[ORM\Column]
    private ?int $episode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $dureeEp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $paysOrigine = null;

    #[ORM\Column(length: 255)]
    private ?string $dateSortie = null;

    #[ORM\ManyToOne(inversedBy: 'series')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeSerie $type_serie = null;

    #[ORM\ManyToOne(inversedBy: 'statusSerie')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatusSerieBase $status_serie_base = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getTitreOriginal(): ?string
    {
        return $this->titreOriginal;
    }

    public function setTitreOriginal(?string $titreOriginal): self
    {
        $this->titreOriginal = $titreOriginal;

        return $this;
    }

    public function getEpisode(): ?int
    {
        return $this->episode;
    }

    public function setEpisode(int $episode): self
    {
        $this->episode = $episode;

        return $this;
    }

    public function getDureeEp(): ?string
    {
        return $this->dureeEp;
    }

    public function setDureeEp(?string $dureeEp): self
    {
        $this->dureeEp = $dureeEp;

        return $this;
    }

    public function getPaysOrigine(): ?string
    {
        return $this->paysOrigine;
    }

    public function setPaysOrigine(?string $paysOrigine): self
    {
        $this->paysOrigine = $paysOrigine;

        return $this;
    }

    public function getDateSortie(): ?string
    {
        return $this->dateSortie;
    }

    public function setDateSortie(string $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getTypeSerie(): ?TypeSerie
    {
        return $this->type_serie;
    }

    public function setTypeSerie(?TypeSerie $type_serie): self
    {
        $this->type_serie = $type_serie;

        return $this;
    }

    public function getStatusSerieBase(): ?StatusSerieBase
    {
        return $this->status_serie_base;
    }

    public function setStatusSerieBase(?StatusSerieBase $status_serie_base): self
    {
        $this->status_serie_base = $status_serie_base;

        return $this;
    }
}
