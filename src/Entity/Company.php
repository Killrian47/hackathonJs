<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberVehicles = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $agencyLocation = null;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: Vehicle::class)]
    private Collection $vehicles;

    #[ORM\OneToMany(mappedBy: 'company', targetEntity: User::class)]
    private Collection $users;
    
    public function __construct()
    {
        $this->vehicles = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNumberVehicles(): ?int
    {
        return $this->numberVehicles;
    }

    public function setNumberVehicles(?int $numberVehicles): self
    {
        $this->numberVehicles = $numberVehicles;

        return $this;
    }

    public function getAgencyLocation(): ?string
    {
        return $this->agencyLocation;
    }

    public function setAgencyLocation(?string $agencyLocation): self
    {
        $this->agencyLocation = $agencyLocation;

        return $this;
    }

    /**
     * @return Collection<int, Vehicle>
     */
    public function getVehicles(): Collection
    {
        return $this->vehicles;
    }

    public function addVehicle(Vehicle $vehicle): self
    {
        if (!$this->vehicles->contains($vehicle)) {
            $this->vehicles->add($vehicle);
            $vehicle->setCompany($this);
        }

        return $this;
    }

    public function removeVehicle(Vehicle $vehicle): self
    {
        if ($this->vehicles->removeElement($vehicle)) {
            // set the owning side to null (unless already changed)
            if ($vehicle->getCompany() === $this) {
                $vehicle->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCompany($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCompany() === $this) {
                $user->setCompany(null);
            }
        }

        return $this;
    }
}
