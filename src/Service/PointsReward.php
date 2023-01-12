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
    public function getPointsReward(UserRepository $userRepository, VehicleRepository $vehicleRepository, RentalRepository $rentalRepository): void
    {

// Créer un champ "rental_end" bool, if true incrémenter points?

        $rental = new Rental();
        $vehicle = new Vehicle();
        $user = new User();
        var_dump($user->getRentals());

//        $rentals = $rentalRepository->findAll();
//        foreach ($rentals as $rental) {
//            $users = $rental->getRenter();
//        $vehicles = $rental->getVehicle();
//        var_dump($vehicles->getVehicleFuelType());
//            foreach ($vehicles as $key => $value) {
//            var_dump($key);
//        }

//        }

//        $us = $userRepository->find('rentals');
//        $vehic = $vehicleRepository->findBy(['id' => $rent]);

//        $vehicleFuelType = 'electric';

//        if ($rental->getRenter() === $user->getId() && $vehicle->getId() === $rental->getVehicle()){
//            if ($vehicle->getVehicleFuelType() === 'electric') {
//                $user->setPoints($user->getPoints() + 10);
//            }
//            if ($vehicle->getVehicleFuelType() === 'hybrid') {
//                $user->setPoints($user->getPoints() + 5);
//            }
//            $userRepository->save($user, true);


        }

}
