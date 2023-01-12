<?php

namespace App\Controller;


use App\Form\SearchVehicleType;
use App\Entity\Company;
use App\Entity\Vehicle;
use App\Repository\CompanyRepository;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

            return $this->renderForm('listofcars.html.twig', [
                'vehicles' => $vehicles,
                'form' => $form
            ]);
        }

        return $this->render('home/index.html.twig', [

            'controller_name' => 'HomeController',
            'form' => $form,
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

    #[Route('/checkout/{id}', name: 'app_checkout')]
    public function checkout(Vehicle $vehicle): Response
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
    public function listofcarsAll(Request $request, VehicleRepository $vehicleRepository, CompanyRepository $companyRepository): Response
    {
        $form = $this->createForm(SearchVehicleType::class);
        $form->handleRequest($request);
        $vehicles = $vehicleRepository->findAll();

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $vehicles = $vehicleRepository->findVehicleByFuelType($search);

            return $this->renderForm('listofcars.html.twig', [
                'vehicles' => $vehicles,
                'form' => $form,
                'companies' => $companyRepository->findAll()
            ]);
        }
        return $this->renderForm('listofcars.html.twig', [
            'vehicles' => $vehicles,
            'companies' => $companyRepository->findAll(),
            'form' => $form
        ]);
    }

    #[Route('/listofcars/{type}/{sort}', name: 'app_listofcars')]
    public function listOfCars(Request $request, VehicleRepository $vehicleRepository, CompanyRepository $companyRepository, string $type = 'all', string $sort = 'unsorted'): Response
    {
        $form = $this->createForm(SearchVehicleType::class);
        $form->handleRequest($request);

        if ($type !== 'all' && $sort !== 'unsorted') {
            return $this->render('listofcars.html.twig', [
                'vehicles' => $vehicleRepository->findBy([$type => $sort]),
                'companies' => $companyRepository->findAll(),
                'form' => $form
            ]);
        }
        return $this->render('listofcars.html.twig', [
            'vehicles' => $vehicleRepository->findAll(),
            'companies' => $companyRepository->findAll(),
            'form' => $form
        ]);
    }

    #[Route('/cardetails/{id}', name: 'app_cardetails')]
    public function cardetails(Vehicle $vehicle): Response
    {
        return $this->render('car-details.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }
}
