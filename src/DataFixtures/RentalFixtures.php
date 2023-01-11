<?php

namespace App\DataFixtures;

use App\Entity\Rental;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RentalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $rental = new Rental();
            $rental->setStartRental($faker->dateTime);
            $rental->setEndRental($faker->dateTime);
            $rental->setStartLocation($faker->address);
            $this->addReference('rental_' . $i, $rental);
            $rental->setRenter($this->getReference('user_' . $i) );
            $rental->setVehicle($this->getReference('vehicle_' . $faker->numberBetween(0, 9)) );
            $manager->persist($rental);
        }

        $manager->flush();

    }

    public function getDependencies(): array
    {
        return [
            VehicleFixtures::class,
            UserFixtures::class,
        ];
    }
}
