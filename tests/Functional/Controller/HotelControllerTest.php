<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HotelControllerTest extends WebTestCase
{
    public function testGetHotelsList()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/hotels'
        );

        $response = $client->getResponse();
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(0, $content);
    }
}

