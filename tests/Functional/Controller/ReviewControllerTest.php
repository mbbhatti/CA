<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReviewControllerTest extends WebTestCase
{
    public function testReviewGraphWithoutParams()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/review'
        );

        $response = $client->getResponse();
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals($content['error'], 'No parameter found.');
    }

    public function testReviewGraphWrongHotelId()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/review',
            ['hotel' => null]
        );

        $response = $client->getResponse();
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals($content['error'], 'A valid hotel value is required.');
    }

    public function testReviewGraphWrongFromDate()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/review',
            ['hotel' => 1, 'fromDate' => null]
        );

        $response = $client->getResponse();
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals($content['error'], 'A valid fromDate is required.');
    }

    public function testReviewGraphWrongToDate()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/review',
            ['hotel' => 1, 'fromDate' => '2019-12-01', 'toDate' => null]
        );

        $response = $client->getResponse();
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(400, $response->getStatusCode());
        $this->assertEquals($content['error'], 'A valid toDate is required.');
    }

    public function testReviewGraphForDays()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/review',
            ['hotel' => 1, 'fromDate' => '2019-12-01', 'toDate' => '2019-12-29']
        );

        $response = $client->getResponse();
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(0, $content);
    }

    public function testReviewGraphForWeeks()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/review',
            ['hotel' => 1, 'fromDate' => '2019-12-01', 'toDate' => '2020-02-28']
        );

        $response = $client->getResponse();
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(0, $content);
    }

    public function testReviewGraphForMonths()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/review',
            ['hotel' => 1, 'fromDate' => '2020-12-01', 'toDate' => '2021-11-01']
        );

        $response = $client->getResponse();
        $content = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertGreaterThanOrEqual(0, $content);
    }
}

