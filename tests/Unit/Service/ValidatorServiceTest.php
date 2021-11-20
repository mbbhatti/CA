<?php

namespace App\Tests\Unit\Service;

use ReflectionClass;
use App\Service\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorServiceTest extends TestCase
{
    public function testisValidWrongHotelId()
    {
        $validator = new Validator();
        $this->assertEquals($validator->isValid(['hotel' => null]), 'A valid hotel value is required.');
    }

    public function testisValidWrongFromDate()
    {
        $validator = new Validator();
        $params = ['hotel' => 1, 'fromDate' => null];
        $this->assertEquals($validator->isValid($params), 'A valid fromDate is required.');
    }

    public function testisValidEmptyFromDate()
    {
        $validator = new Validator();
        $params = ['hotel' => 1, 'fromDate' => ''];
        $this->assertEquals($validator->isValid($params), 'A valid fromDate is required.');
    }

    public function testisValidWrongToDate()
    {
        $validator = new Validator();
        $params = ['hotel' => 1, 'fromDate' => '2020-12-01', 'toDate' => null];
        $this->assertEquals($validator->isValid($params), 'A valid toDate is required.');
    }

    public function testisValidEmptyToDate()
    {
        $validator = new Validator();
        $params = ['hotel' => 1, 'fromDate' => '2020-12-01', 'toDate' => 0];
        $this->assertEquals($validator->isValid($params), 'A valid toDate is required.');
    }

    public function testValidateDate()
    {
        $validator = new Validator();
        $reflection = new ReflectionClass(get_class($validator));
        $method = $reflection->getMethod('validateDate');
        $method->setAccessible(true);
        $response = $method->invokeArgs($validator, ['2021-12-01']);
        $this->assertTrue($response);

        $response = $method->invokeArgs($validator, ['2021/12/01']);
        $this->assertFalse($response);
    }
}

