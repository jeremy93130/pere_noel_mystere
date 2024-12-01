<?php

namespace App\Entity;

use App\Repository\FamillyGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FamillyGroupRepository::class)]
class FamillyGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, user>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'famillyGroup')]
    private Collection $user;

    /**
     * @var Collection<int, guest>
     */
    #[ORM\OneToMany(targetEntity: Guest::class, mappedBy: 'famillygroup')]
    private Collection $guest;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->guest = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, user>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(user $user): static
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setFamillyGroup($this);
        }

        return $this;
    }

    public function removeUser(user $user): static
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getFamillyGroup() === $this) {
                $user->setFamillyGroup(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, guest>
     */
    public function getGuest(): Collection
    {
        return $this->guest;
    }

    public function addGuest(guest $guest): static
    {
        if (!$this->guest->contains($guest)) {
            $this->guest->add($guest);
            $guest->setFamillygroup($this);
        }

        return $this;
    }

    public function removeGuest(guest $guest): static
    {
        if ($this->guest->removeElement($guest)) {
            // set the owning side to null (unless already changed)
            if ($guest->getFamillygroup() === $this) {
                $guest->setFamillygroup(null);
            }
        }

        return $this;
    }
}
