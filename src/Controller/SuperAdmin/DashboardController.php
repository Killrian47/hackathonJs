<?php

namespace App\Controller\SuperAdmin;

use App\Entity\Company;
use App\Entity\User;
use App\Entity\Vehicle;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/superadmin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirect($adminUrlGenerator->setController(VehicleCrudController::class)->generateUrl());
        }
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
        }
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('HackathonJs');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('User', 'fa fa-user', User::class)
            ->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToCrud('Companies', 'fa fa-square-parking', Company::class)
            ->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToCrud('Vehicles', 'fa fa-car', Vehicle::class);

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);


    }
}
