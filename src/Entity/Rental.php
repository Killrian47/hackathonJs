<?php

namespace App\Entity;

use App\Repository\RentalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RentalRepository::class)]
class Rental
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startRental = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endRental = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $startLocation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $endLocation = null;

    #[ORM\ManyToOne(inversedBy: 'rentals')]
    private ?User $renter = null;

    #[ORM\ManyToOne(inversedBy: 'rentals')]
    private ?Vehicle $vehicle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartRental(): ?\DateTimeInterface
    {
        return $this->startRental;
    }

    public function setStartRental(?\DateTimeInterface $startRental): self
    {
        $this->startRental = $startRental;

        return $this;
    }

    public function getEndRental(): ?\DateTimeInterface
    {
        return $this->endRental;
    }

    public function setEndRental(?\DateTimeInterface $endRental): self
    {
        $this->endRental = $endRental;

        return $this;
    }

    public function getStartLocation(): ?string
    {
        return $this->startLocation;
    }

    public function setStartLocation(?string $startLocation): self
    {
        $this->startLocation = $startLocation;

        return $this;
    }

    public function getEndLocation(): ?string
    {
        return $this->endLocation;
    }

    public function setEndLocation(?string $endLocation): self
    {
        $this->endLocation = $endLocation;

        return $this;
    }

    public function getRenter(): ?User
    {
        return $this->renter;
    }

    public function setRenter(?User $renter): self
    {
        $this->renter = $renter;

        return $this;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }
}
