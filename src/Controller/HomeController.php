<?php

namespace App\Controller;

use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        //handle ajax request
//        if ($request->isXmlHttpRequest()) {
//            return new JsonResponse([
//                'content' => $this->renderView('_includes/_vehicles_cards.html.twig', [
//                    'vehicles' => $vehicleRepository->findAll(),
//                ])
//            ]);
//        }

        return $this->render('home/index.html.twig', [

        ]);
    }

    #[Route('/vehicles/{type}/{sort}', name: 'app_vehicles')]
    public function showVehicles(Request $request, VehicleRepository $vehicleRepository, string $type = 'all', string|int $sort = 'unsorted'): Response
    {
        if ($type !== 'all' && $sort !== 'unsorted') {
            return $this->render('home/index.html.twig', [
                'vehicles' => $vehicleRepository->findBy([$type => $sort])
            ]);
        }
        return $this->render('home/index.html.twig', [
            'vehicles' => $vehicleRepository->findAll()
        ]);
    }

    #[Route('/carListingGrid', name: 'app_carListGrid')]
    public function carListingGrid(): Response
    {
        return $this->render('car-listing-grid.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/carListingList', name: 'app_carListList')]
    public function carListingList(): Response
    {
        return $this->render('car-listing-list.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('login.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('about.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('contactus.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/checkout', name: 'app_checkout')]
    public function checkout(): Response
    {
        return $this->render('checkout.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/reservation', name: 'app_reservation')]
    public function reservation(): Response
    {
        return $this->render('reservation.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/listofcars', name: 'app_listofcars')]
    public function listofcars(): Response
    {
        return $this->render('listofcars.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
