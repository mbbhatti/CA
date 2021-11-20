<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Hotel;
use PHPUnit\Framework\TestCase;

class HotelEntityTest extends TestCase
{
    public function testId()
    {
        $hotel = new Hotel();
        $this->assertEquals(null, $hotel->getId());
    }

    public function testName()
    {
        $hotel = new Hotel();
        $hotel->setName('AB');

        $this->assertEquals('AB', $hotel->getName());
        $this->assertNotEquals('191', $hotel->getName());
    }
}

