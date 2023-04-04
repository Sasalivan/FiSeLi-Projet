<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\OneToMany(mappedBy: 'user_episode', targetEntity: StatusSerie::class)]
    private Collection $statusSeries;


    public function __construct()
    {
        $this->statusSeries = new ArrayCollection();
    }

    // #[ORM\Column(type: Types::DATE_MUTABLE)]
    // private ?\DateTimeInterface $Birthday = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    // public function getBirthday(): ?\DateTimeInterface
    // {
    //     return $this->Birthday;
    // }

    // public function setBirthday(\DateTimeInterface $Birthday): self
    // {
    //     $this->Birthday = $Birthday;

    //     return $this;
    // }

    /**
     * @return Collection<int, StatusSerie>
     */
    public function getStatusSeries(): Collection
    {
        return $this->statusSeries;
    }

    public function addStatusSerie(StatusSerie $statusSerie): self
    {
        if (!$this->statusSeries->contains($statusSerie)) {
            $this->statusSeries->add($statusSerie);
            $statusSerie->setUserEpisode($this);
        }

        return $this;
    }

    public function removeStatusSerie(StatusSerie $statusSerie): self
    {
        if ($this->statusSeries->removeElement($statusSerie)) {
            // set the owning side to null (unless already changed)
            if ($statusSerie->getUserEpisode() === $this) {
                $statusSerie->setUserEpisode(null);
            }
        }

        return $this;
    }

    public function addStatusSeries(StatusSerie $statusSeries): self
    {
        if (!$this->statusSeries->contains($statusSeries)) {
            $this->statusSeries->add($statusSeries);
            $statusSeries->setUserEpisode($this);
        }

        return $this;
    }

    public function removeStatusSeries(StatusSerie $statusSeries): self
    {
        if ($this->statusSeries->removeElement($statusSeries)) {
            // set the owning side to null (unless already changed)
            if ($statusSeries->getUserEpisode() === $this) {
                $statusSeries->setUserEpisode(null);
            }
        }

        return $this;
    }

}
