<?php

namespace App\Controller\SuperAdmin;

use App\Entity\Vehicle;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VehicleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vehicle::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('vehicleBrand'),
            TextField::new('vehicleModel'),
            TextField::new('vehicleType'),
            TextField::new('vehicleGearBoxType'),
            IntegerField::new('vehicleSeatCount'),
            IntegerField::new('vehicleDoorCount'),
            TextField::new('vehicleFuelType'),
        ];
    }

}
