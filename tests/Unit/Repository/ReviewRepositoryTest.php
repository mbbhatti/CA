<?php

namespace App\Tests\Unit\Repository;

use App\Entity\Review;
use App\Repository\ReviewRepository;
use App\Tests\lib\TestEntityManager;

class ReviewRepositoryTest extends TestEntityManager
{
    public function testConstructor()
    {
        $kernel = self::bootKernel();
        $registry = $kernel->getContainer()->get('doctrine');
        $review = $this->getMockBuilder(Review::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response = new ReviewRepository($registry, $review);

        $this->assertNotEmpty($response);
    }

    public function testGetDayGroupWithoutData()
    {
        $response = $this->entityManager->getRepository(Review::class)->getDayGroup([]);
        $this->assertEmpty($response);
    }

    public function testGetDayGroupWithoutInvalidData()
    {
        $data = [
            'hotel' => 0,
            'fromDate' => '',
            'toDate' => ''
        ];

        $response = $this->entityManager->getRepository(Review::class)->getDayGroup($data);
        $this->assertEmpty($response);
    }

    public function testGetDayGroup()
    {
        $data = [
            'hotel' => 1,
            'fromDate' => '2019-12-01',
            'toDate' => '2019-12-29'
        ];

        $response = $this->entityManager->getRepository(Review::class)->getDayGroup($data);
        $this->assertGreaterThanOrEqual(0, $response);
    }

    public function testGetWeekGroupWithoutData()
    {
        $response = $this->entityManager->getRepository(Review::class)->getWeekGroup([]);
        $this->assertEmpty($response);
    }

    public function testGetWeekGroupWithoutInvalidData()
    {
        $data = [
            'hotel' => 0,
            'fromDate' => '',
            'toDate' => ''
        ];

        $response = $this->entityManager->getRepository(Review::class)->getWeekGroup($data);
        $this->assertEmpty($response);
    }

    public function testGetWeekGroup()
    {
        $data = [
            'hotel' => 1,
            'fromDate' => '2019-12-01',
            'toDate' => '2020-02-28'
        ];

        $response = $this->entityManager->getRepository(Review::class)->getWeekGroup($data);
        $this->assertGreaterThanOrEqual(0, $response);
    }

    public function testGetMonthGroupWithoutData()
    {
        $response = $this->entityManager->getRepository(Review::class)->getMonthGroup([]);
        $this->assertEmpty($response);
    }

    public function testGetMonthGroupWithoutInvalidData()
    {
        $data = [
            'hotel' => 0,
            'fromDate' => '',
            'toDate' => ''
        ];

        $response = $this->entityManager->getRepository(Review::class)->getMonthGroup($data);
        $this->assertEmpty($response);
    }

    public function testGetMonthGroup()
    {
        $data = [
            'hotel' => 0,
            'fromDate' => '2020-12-01',
            'toDate' => '2021-11-01'
        ];

        $response = $this->entityManager->getRepository(Review::class)->getMonthGroup($data);
        $this->assertEmpty($response);
    }
}

