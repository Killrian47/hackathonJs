<?php

namespace App\Service;

use App\Entity\Rental;
use App\Entity\User;
use App\Entity\Vehicle;
use App\Repository\RentalRepository;
use App\Repository\UserRepository;
use App\Repository\VehicleRepository;

class PointsReward
{
    public function getPointsReward(RentalRepository $rentalRepository, UserRepository $userRepository): void
    {
        $rentals = $rentalRepository->findAll();

        foreach ($rentals as $rental) {
            $rentedVehicle = $rental->getVehicle();
            $renter = $rental->getRenter();

            $endRentingDate = $rental->getEndRental();
            $startRentingDate = $rental->getStartRental();
            $today = new \DateTime('now');
            $endRentingDateTS = $endRentingDate->getTimestamp();
            $startRentingDateTS = $startRentingDate->getTimestamp();
            $difference = $endRentingDateTS - $startRentingDateTS;
            $hours = floor($difference / (60 * 60));

            if ($rentedVehicle->getVehicleFuelType() === 'electric' && $today->format('Y-m-d') === $endRentingDate->format('Y-m-d') ) {
                $renter->setPoints($renter->getPoints() + 10 * $hours);
            }if ($rentedVehicle->getVehicleFuelType() === 'hybrid' && $today->format('Y-m-d') === $endRentingDate->format('Y-m-d')) {
                $renter->setPoints($renter->getPoints() + 5 * $hours );
            }
            $userRepository->save($renter, true);
        }
    }
}
