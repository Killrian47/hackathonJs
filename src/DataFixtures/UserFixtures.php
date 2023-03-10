<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setFullName($faker->firstName . ' ' . $faker->lastName);
            $user->setEmail($faker->email);
            $user->setPassword(password_hash('1234', PASSWORD_DEFAULT));
            $this->addReference('user_' . $i, $user);
            $manager->persist($user);
        }
        $manager->flush();
    }


}
