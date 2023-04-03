<?php

namespace App\Entity;

use App\Repository\GenreSerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreSerieRepository::class)]
class GenreSerie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_genre = null;

    #[ORM\ManyToMany(targetEntity: Serie::class, mappedBy: 'genres')]
    private Collection $serie_genre;

    public function __construct()
    {
        $this->serie_genre = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGenre(): ?string
    {
        return $this->nom_genre;
    }

    public function setNomGenre(string $nom_genre): self
    {
        $this->nom_genre = $nom_genre;

        return $this;
    }

    /**
     * @return Collection<int, Serie>
     */
    public function getSerieGenre(): Collection
    {
        return $this->serie_genre;
    }

    public function addSerieGenre(Serie $serieGenre): self
    {
        if (!$this->serie_genre->contains($serieGenre)) {
            $this->serie_genre->add($serieGenre);
            $serieGenre->addGenre($this);
        }

        return $this;
    }

    public function removeSerieGenre(Serie $serieGenre): self
    {
        if ($this->serie_genre->removeElement($serieGenre)) {
            $serieGenre->removeGenre($this);
        }

        return $this;
    }

    public function __toString(){
         return $this->nom_genre;
    }

}
