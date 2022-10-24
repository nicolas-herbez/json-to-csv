<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PowerTest extends WebTestCase
{
    public function testGetList(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/powers/');
        $responseContent = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertStringContainsString("Test power 1", $responseContent);
        $this->assertStringContainsString("Test power 2", $responseContent);
    }

    public function testCreate(): void
    {
        $newPower = '{"name": "Test power 3", "code": "TP3" }';

        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/powers/',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $newPower
        );
        $responseContent = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertStringContainsString("Test power 3", $responseContent);
    }

    public function testCanNotCreateAAlreadyExistPower(): void
    {
        $newPower = '{"name": "Test power 3", "code": "TP3" }';

        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/powers/',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $newPower
        );
        $responseContent = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertStringContainsString("This name already exists.", $responseContent);
        $this->assertStringContainsString("This code already exists.", $responseContent);
    }

    public function testRead(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/powers/1');
        $responseContent = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertStringContainsString("Test power 1", $responseContent);
    }

    public function testReadAUnexistPowerShouldReturnA404Error(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/powers/4');
        $responseStatusCode = $client->getResponse()->getStatusCode();

        $this->assertEquals($responseStatusCode, 404);
        $this->assertResponseHeaderSame('content-type', 'application/json');
    }

    public function testUpdate(): void
    {
        $updatedPower = '{"name": "Test power 3 updated", "code": "TP3U" }';

        $client = static::createClient();
        $crawler = $client->request(
            'PUT',
            '/powers/3',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $updatedPower
        );
        $responseContent = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertStringContainsString("Test power 3 updated", $responseContent);
        $this->assertStringContainsString("TP3U", $responseContent);
    }

    public function testCanNotUpdateWithAAlreadyExistPower(): void
    {
        $updatedPower = '{"name": "Test power 1", "code": "TP1" }';

        $client = static::createClient();
        $crawler = $client->request(
            'PUT',
            '/powers/3',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $updatedPower
        );
        $responseContent = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertStringContainsString("This name already exists.", $responseContent);
        $this->assertStringContainsString("This code already exists.", $responseContent);
    }

    public function testUpdateAUnexistPowerShouldReturnA404Error(): void
    {
        $updatedPower = '{"name": "Test power 4 updated", "code": "TP4U" }';

        $client = static::createClient();
        $crawler = $client->request(
            'PUT',
            '/powers/4',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $updatedPower
        );
        $responseStatusCode = $client->getResponse()->getStatusCode();

        $this->assertEquals($responseStatusCode, 404);
        $this->assertResponseHeaderSame('content-type', 'application/json');
    }

    public function testDelete(): void
    {
        $client = static::createClient();
        $crawler = $client->request('DELETE', '/powers/1');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
    }

    public function testDeleteAUnexistPowerShouldReturnA404Error(): void
    {
        $client = static::createClient();
        $crawler = $client->request('DELETE', '/powers/4');
        $responseStatusCode = $client->getResponse()->getStatusCode();

        $this->assertEquals($responseStatusCode, 404);
        $this->assertResponseHeaderSame('content-type', 'application/json');
    }
}
