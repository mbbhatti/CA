<?php

namespace App\DataFixtures;

use App\Entity\Hotel;
use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ReviewDataFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $hotels = $manager->getRepository(Hotel::class)->findAll();

        $faker = Factory::create('de_DE');
        for ($i = 0; $i < 10000; $i++) {
            $review = new Review();
            $review->setHotel($faker->randomElement($hotels));
            $review->setScore($faker->numberBetween(1, 100));
            $review->setComment($faker->realText());
            $review->setCreatedDate($faker->dateTimeBetween($startDate = '-2 years'));
            $manager->persist($review);
        }
        $manager->flush();
    }
}

