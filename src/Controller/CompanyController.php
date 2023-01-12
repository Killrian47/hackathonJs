<?php

namespace App\Controller;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    #[Route('/company/{id}', name: 'app_company')]
    public function index(Company $company , VehicleRepository $vehicleRepository): Response
    {
        $vehicles = $vehicleRepository->findBy(['company' => $company]);

        return $this->render('company/index.html.twig', [
            'vehicles' => $vehicles,
        ]);
    }
}
