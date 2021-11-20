<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class HotelDataFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('de_DE');
        for ($i = 0; $i < 10; $i++) {
            $hotel = (new Hotel())->setName($faker->lastName . ' Hotel');
            $manager->persist($hotel);
        }
        $manager->flush();
    }
}

