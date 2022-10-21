<?php

namespace App\Tests\Entity;

use App\Entity\Power;
use PHPUnit\Framework\TestCase;

class PowerTest extends TestCase
{
    private Power $power;

    protected function setUp(): void
    {
        parent::setUp();

        $this->power = new Power();
    }

    public function testGetId(): void
    {
        $this->assertTrue($this->power->getId() === null);
    }

    public function testSetAndGetName(): void
    {
        $name = "Test power";
        $response = $this->power->setName($name);

        $this->assertInstanceOf(Power::class, $response);
        $this->assertEquals($name, $this->power->getName());
    }

    public function testSetAndGetCode(): void
    {
        $code = "TP";
        $response = $this->power->setCode($code);

        $this->assertInstanceOf(Power::class, $response);
        $this->assertEquals($code, $this->power->getCode());
    }
}
