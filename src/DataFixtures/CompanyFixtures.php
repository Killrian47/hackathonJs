<?php

namespace App\DataFixtures;

use App\Entity\Company;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CompanyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $company = new Company();
            $company->setName($faker->name);
            $company->setNumberVehicles($faker->numberBetween(0, 9));
            $company->setAgencyLocation($faker->address);
            $this->addReference('company_' . $i, $company);
            $manager->persist($company);
        }

        $manager->flush();
    }
}
