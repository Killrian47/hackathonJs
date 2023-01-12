<?php

namespace App\Controller;

use App\Entity\Rental;
use App\Entity\Vehicle;
use App\Form\RentType;
use App\Repository\CompanyRepository;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
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
    public function showVehicles(Request $request, VehicleRepository $vehicleRepository, CompanyRepository $companyRepository, string $type = 'all', string|int $sort = 'unsorted'): Response
    {
        if ($type !== 'all' && $sort !== 'unsorted') {
            return $this->render('home/index.html.twig', [
                'vehicles' => $vehicleRepository->findBy([$type => $sort]),
                'companies' => $companyRepository->findAll(),
            ]);
        }
        return $this->render('home/index.html.twig', [
            'vehicles' => $vehicleRepository->findAll(),
            'companies' => $companyRepository->findAll(),
        ]);
    }

    #[Route('/vehicle/{id}', name: 'app_vehicle_details')]
    public function vehicleDetails(Request $request, Vehicle $vehicle, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(RentType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dd($form);
            $rent = new Rental();
            $rent->setRenter($this->getUser());
            $rent->setVehicle($vehicle);
            $rent->setStartLocation($vehicle->getCompany()->getAgencyLocation());
            $manager->persist($rent);
            $manager->flush();
        }

        return $this->render('home/vehicleDetails.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form,
        ]);
    }

}
