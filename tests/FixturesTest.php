<?php
namespace App\Tests;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use App\DataFixtures\HotelDataFixtures;
use App\DataFixtures\ReviewDataFixtures;
use App\Tests\lib\TestEntityManager;

class FixturesTest extends TestEntityManager
{
    public function testDataFixtures()
    {
        $purger = new ORMPurger($this->entityManager);
        $executor = new ORMExecutor($this->entityManager, $purger);

        $loader = new Loader();
        $loader->addFixture(new HotelDataFixtures());
        $executor->execute($loader->getFixtures());

        $loader->addFixture(new ReviewDataFixtures());
        $executor->execute($loader->getFixtures());

        $this->assertTrue(true);
    }
}

