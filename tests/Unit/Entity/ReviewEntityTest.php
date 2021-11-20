<?php

namespace App\Tests\Unit\Entity;

use DateTime;
use App\Entity\Hotel;
use App\Entity\Review;
use PHPUnit\Framework\TestCase;

class ReviewEntityTest extends TestCase
{
    public function testId()
    {
        $review = new Review();
        $this->assertEquals(null, $review->getId());
    }

    public function testHotel()
    {
        $review = new Review();
        $hotel = new Hotel(1);
        $review->setHotel($hotel);

        $this->assertEquals($hotel, $review->getHotel());
        $this->assertNotEquals('AB', $review->getHotel());
    }

    public function testScore()
    {
        $review = new Review();
        $review->setScore(99);

        $this->assertEquals(99, $review->getScore());
        $this->assertNotEquals(10, $review->getScore());
    }

    public function testComments()
    {
        $review = new Review();
        $review->setComment('Hello');

        $this->assertEquals('Hello', $review->getComment());
        $this->assertNotEquals('World', $review->getComment());
    }

    public function testCreatedDate()
    {
        $review = new Review();

        $current = new DateTime();
        $review->setCreatedDate($current);
        $this->assertEquals($current, $review->getCreatedDate());

        $date = new DateTime('2016-09-14 13:41:06');
        $review->setCreatedDate($date);
        $this->assertEquals($date, $review->getCreatedDate());
    }
}

