<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vehicleBrand = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vehicleModel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vehicleType = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vehicleGearBoxType = null;

    #[ORM\Column(nullable: true)]
    private ?int $vehicleSeatCount = null;

    #[ORM\Column(nullable: true)]
    private ?int $vehicleDoorCount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vehicleFuelType = null;

    #[ORM\Column(nullable: true)]
    private ?int $year = null;

    #[ORM\Column(nullable: true)]
    private ?bool $status = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'vehicle')]
    private Collection $users;

    #[ORM\ManyToOne(inversedBy: 'vehicles')]
    private ?Company $company = null;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Rental::class)]
    private Collection $rentals;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $vehicle_picture = null;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->rentals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVehicleBrand(): ?string
    {
        return $this->vehicleBrand;
    }

    public function setVehicleBrand(?string $vehicleBrand): self
    {
        $this->vehicleBrand = $vehicleBrand;

        return $this;
    }

    public function getVehicleModel(): ?string
    {
        return $this->vehicleModel;
    }

    public function setVehicleModel(?string $vehicleModel): self
    {
        $this->vehicleModel = $vehicleModel;

        return $this;
    }

    public function getVehicleType(): ?string
    {
        return $this->vehicleType;
    }

    public function setVehicleType(?string $vehicleType): self
    {
        $this->vehicleType = $vehicleType;

        return $this;
    }

    public function getVehicleGearBoxType(): ?string
    {
        return $this->vehicleGearBoxType;
    }

    public function setVehicleGearBoxType(?string $vehicleGearBoxType): self
    {
        $this->vehicleGearBoxType = $vehicleGearBoxType;

        return $this;
    }

    public function getVehicleSeatCount(): ?int
    {
        return $this->vehicleSeatCount;
    }

    public function setVehicleSeatCount(?int $vehicleSeatCount): self
    {
        $this->vehicleSeatCount = $vehicleSeatCount;

        return $this;
    }

    public function getVehicleDoorCount(): ?int
    {
        return $this->vehicleDoorCount;
    }

    public function setVehicleDoorCount(?int $vehicleDoorCount): self
    {
        $this->vehicleDoorCount = $vehicleDoorCount;

        return $this;
    }

    public function getVehicleFuelType(): ?string
    {
        return $this->vehicleFuelType;
    }

    public function setVehicleFuelType(?string $vehicleFuelType): self
    {
        $this->vehicleFuelType = $vehicleFuelType;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): self
    {
        $this->price = $price;

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
            $user->addVehicle($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeVehicle($this);
        }

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return Collection<int, Rental>
     */
    public function getRentals(): Collection
    {
        return $this->rentals;
    }

    public function addRental(Rental $rental): self
    {
        if (!$this->rentals->contains($rental)) {
            $this->rentals->add($rental);
            $rental->setVehicle($this);
        }

        return $this;
    }

    public function removeRental(Rental $rental): self
    {
        if ($this->rentals->removeElement($rental)) {
            // set the owning side to null (unless already changed)
            if ($rental->getVehicle() === $this) {
                $rental->setVehicle(null);
            }
        }

        return $this;
    }

    public function getVehiclePicture(): ?string
    {
        return $this->vehicle_picture;
    }

    public function setVehiclePicture(?string $vehicle_picture): self
    {
        $this->vehicle_picture = $vehicle_picture;

        return $this;
    }
}
