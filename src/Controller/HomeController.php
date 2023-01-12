<?php

namespace App\Controller;

use App\Entity\Rental;
use App\Entity\User;
use App\Entity\Vehicle;
use App\Repository\RentalRepository;
use App\Repository\UserRepository;
use App\Repository\VehicleRepository;
use App\Service\PointsReward;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(UserRepository $userRepository, VehicleRepository $vehicleRepository, RentalRepository $rentalRepository): Response
    {
        $rentals = $rentalRepository->findAll();
        $users = $userRepository->findAll();
        $vehicles = $vehicleRepository->findAll();

        foreach ($rentals as $rental) {
            $vehiclesRented = $rental->getVehicle();
            $vehicleFuelType = $vehiclesRented->getVehicleFuelType();
            $vehicleRentedId = $vehiclesRented->getId();
            $renters = $rental->getRenter();
            $renterId = $renters->getId();
            foreach ($users as $user) {
                $userId = $user->getId();
                if ($renterId === $userId) {
                    foreach ($vehicles as $vehicle) {
                    $vehicleId = $vehicle->getId();
                        if ($vehicleId === $vehicleRentedId) {
                            if ($vehicleFuelType === 'electric') {
                                $users = new User();
                                $users->setPoints($users->getPoints() + 10);
                         }
                            if ($vehicleFuelType === 'hybrid') {
                             $users->setPoints($users->getPoints() + 5);
                            }
                            $userRepository->save($users, true);
                        }

                        }
                    }
                var_dump($users->getPoints());
            }
        }
        die();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
