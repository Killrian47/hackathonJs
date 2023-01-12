<?php

namespace App\Controller;

use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(VehicleRepository $vehicleRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'vehicles' => $vehicleRepository->findAll(),
        ]);
    }

    #[Route('/vehicles/{sort}/{value}', name: 'app_vehicle')]
    public function showVehicles(Request $request): Response
    {
        //handle ajax request
        if ($request->isXmlHttpRequest()) {
            return new JsonResponse([
                'content' => $this->renderView('_includes/_vehicle_cards.html.twig', [
                    'videos' => $filter->getOrderedCategoryVideos($sort, $slug),
                ])
            ]);
        }

        return $this->render('home/singleCategory.html.twig', [
            'videos' => $filter->getOrderedCategoryVideos($sort, $slug),
        ]);
    }
}
