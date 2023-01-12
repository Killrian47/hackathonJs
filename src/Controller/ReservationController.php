<?php

namespace App\Controller;

use App\Repository\RentalRepository;
use App\Repository\UserRepository;
use App\Service\PointsReward;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(RentalRepository $rentalRepository, PointsReward $pointsReward): Response
    {
        $rentals = $rentalRepository->findAll();

        return $this->render('reservation/index.html.twig', [
            'rentals' => $rentals,
        ]);
    }

    #[Route('/pointsAdded', name: 'app_points_added')]
    public function addPoints(PointsReward $pointsReward, RentalRepository $rentalRepository, UserRepository $userRepository): Response
    {

        $pointsReward->getPointsReward($rentalRepository, $userRepository);

        return $this->redirectToRoute('app_reservation');
    }


}
