<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardControllerTest extends WebTestCase
{
    public function testDashboard()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/'
        );

        $response = $client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }
}

