<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
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

    #[ORM\Column]
    private ?int $dureeEp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $paysOrigine = null;

    #[ORM\Column(length: 255)]
    private ?string $dateSortie = null;

    #[ORM\ManyToOne(targetEntity: TypeSerie::class, inversedBy: 'series')]
    #[ORM\JoinColumn(nullable: true)]
    private ?TypeSerie $type_serie = null;

    #[ORM\ManyToMany(targetEntity: GenreSerie::class, inversedBy: 'serie_genre')]
    private Collection $genres;


    #[ORM\Column(length: 20)]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'serie', targetEntity: StatusSerie::class, cascade: ['persist'])]
    private Collection $statuses;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'series', targetEntity: Images::class)]
    private Collection $images;


    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->statuses = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

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

    public function getDureeEp(): ?int
    {
        return $this->dureeEp;
    }

    public function setDureeEp(?int $dureeEp): self
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


    /**
     * @return Collection<int, GenreSerie>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(GenreSerie $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(GenreSerie $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }
    

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, StatusSerie>
     */
    public function getStatuses(): Collection
    {
        return $this->statuses;
    }

    public function addStatus(StatusSerie $status): self
    {
        if (!$this->statuses->contains($status)) {
            $this->statuses->add($status);
            $status->setSerie($this);
        }

        return $this;
    }

    public function removeStatus(StatusSerie $status): self
    {
        if ($this->statuses->removeElement($status)) {
            // set the owning side to null (unless already changed)
            if ($status->getSerie() === $this) {
                $status->setSerie(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setSeries($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getSeries() === $this) {
                $image->setSeries(null);
            }
        }

        return $this;
    }


}
