<?php

namespace App\Tests\Unit\Repository;

use App\Entity\Hotel;
use App\Repository\HotelRepository;
use App\Tests\lib\TestEntityManager;

class HotelRepositoryTest extends TestEntityManager
{
    public function testConstructor()
    {
        $kernel = self::bootKernel();
        $registry = $kernel->getContainer()->get('doctrine');
        $hotel = $this->getMockBuilder(Hotel::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response = new HotelRepository($registry, $hotel);

        $this->assertNotEmpty($response);
    }

    public function testGetAll()
    {
        $hotels = $this->entityManager->getRepository(Hotel::class)->getAll();

        $this->assertGreaterThanOrEqual(0, $hotels);
    }
}

