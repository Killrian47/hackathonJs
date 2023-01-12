<?php

namespace App\Controller;

use App\Entity\Rental;
use App\Entity\User;
use App\Repository\RentalRepository;
use App\Repository\UserRepository;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/myrent', name: 'app_user')]
    public function index(UserInterface $user, RentalRepository $rentalRepository): Response
    {
        $currentDate = date('Y-m-d');
        $myRental = $rentalRepository->findBy(['renter' => $user]);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'rental' => $myRental,
            'currentDate' => $currentDate
        ]);
    }

    #[Route('/myrent/{id<\d+>}', name: 'app_delete_rent', methods: ['POST'])]
    public function deleteMyRent(Request $request, Rental $rental, RentalRepository $rentalRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $rental->getId(), $request->request->get('_token'))) {
            $rentalRepository->remove($rental, true);
        }

        return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
    }
}
