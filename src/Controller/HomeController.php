<?php

namespace App\Controller;


use App\Form\SearchVehicleType;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, VehicleRepository $vehicleRepository): Response
    {
        $form = $this->createForm(SearchVehicleType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $vehicles = $vehicleRepository->findVehicleByFuelType($search);

            return $this->renderForm('vehicle/searchedVehicle.html.twig', [
                'vehicles' => $vehicles,
                'form' => $form
            ]);
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form,
        ]);
    }

    #[Route('/carListingGrid', name: 'app_carListGrid')]
    public function carListingGrid(Request $request): Response
    {
        $form = $this->createForm(SearchVehicleType::class);
        $form->handleRequest($request);

        return $this->render('car-listing-grid.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form,

        ]);
    }

    #[Route('/carListingList', name: 'app_carListList')]
    public function carListingList(Request $request): Response
    {
        $form = $this->createForm(SearchVehicleType::class);
        $form->handleRequest($request);

        return $this->render('car-listing-list.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form,

        ]);
    }

    #[Route('/loginpage', name: 'app_loginpage')]
    public function loginpage(AuthenticationUtils $authenticationUtils): Response
    {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login.html.twig', [
            'controller_name' => 'HomeController',
            'last_username' => $lastUsername, 'error' => $error
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
    public function listofcars(Request $request, VehicleRepository $vehicleRepository): Response
    {
        $form = $this->createForm(SearchVehicleType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $vehicles = $vehicleRepository->findVehicleByFuelType($search);

            return $this->renderForm('listofcars.html.twig', [
                'vehicles' => $vehicles,
                'form' => $form
            ]);
        }

        return $this->render('listofcars.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/cardetails', name: 'app_cardetails')]
    public function cardetails(): Response
    {
        return $this->render('car-details.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
