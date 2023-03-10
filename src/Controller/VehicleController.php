<?php

namespace App\Controller;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/vehicle')]
class VehicleController extends AbstractController
{
    #[Route('/', name: 'app_vehicle_index')]
    public function index(VehicleRepository $vehicleRepository, Request $request): Response
    {
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData();
            $vehicles = $vehicleRepository->findVehicleByFuelType($search);

            return $this->renderForm('vehicle/searchedVehicle.html.twig', [
                'vehicles' => $vehicles,
                'form' => $form
            ]);
        }
        return $this->render('vehicle/index.html.twig', [
            'vehicles' => $vehicleRepository->findBy([
                'status' => true
            ]),
            'form' => $form
        ]);
    }


    #[Route('/new', name: 'app_vehicle_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, VehicleRepository $vehicleRepository): Response
    {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vehicleRepository->save($vehicle, true);

            return $this->redirectToRoute('app_vehicle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vehicle/new.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_vehicle_show', methods: ['GET'])]
    public function show(Vehicle $vehicle): Response
    {
        return $this->render('vehicle/show.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vehicle_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Vehicle $vehicle, VehicleRepository $vehicleRepository): Response
    {
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vehicleRepository->save($vehicle, true);

            return $this->redirectToRoute('app_vehicle_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('vehicle/edit.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vehicle_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Vehicle $vehicle, VehicleRepository $vehicleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vehicle->getId(), $request->request->get('_token'))) {
            $vehicleRepository->remove($vehicle, true);
        }

        return $this->redirectToRoute('app_vehicle_index', [], Response::HTTP_SEE_OTHER);
    }
}
