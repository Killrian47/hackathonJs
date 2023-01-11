<?php

namespace App\DataFixtures;

use App\Entity\Company;
use App\Entity\Vehicle;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\Fakecar;
use Faker\Generator;

class VehicleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $vehicle = new Vehicle();
            $vehicle->setVehicleBrand(FakeCar::vehicleType());
            $vehicle->setVehicleModel(FakeCar::vehicleModel());
            $vehicle->setVehicleType(FakeCar::vehicleType());
            $vehicle->setVehicleGearBoxType(FakeCar::vehicleGearBoxType());
            $vehicle->setVehicleSeatCount(FakeCar::vehicleSeatCount());
            $vehicle->setVehicleDoorCount(FakeCar::vehicleDoorCount());
            $vehicle->setVehicleFuelType(FakeCar::vehicleFuelType());
            $vehicle->setYear($faker->numberBetween(1995, 2020));
            $vehicle->setStatus($faker->numberBetween(0, 1));
            $vehicle->setPrice($faker->numberBetween(50, 300));
            $this->addReference('vehicle_' . $i, $vehicle);
            $vehicle->addUser($this->getReference('user_' . $faker->numberBetween(0, 9)) );
            $vehicle->setCompany($this->getReference('company_' . $faker->numberBetween(0, 9)) );

            $manager->persist($vehicle);
        }
        $manager->flush();

    }

    public function getDependencies(): array
    {
        return [
            CompanyFixtures::class,
            UserFixtures::class,
        ];
    }
}
