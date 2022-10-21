<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PowerTest extends WebTestCase
{
    public function testGetList(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/powers/');
        $response = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertStringContainsString("Test power 1", $response);
        $this->assertStringContainsString("Test power 2", $response);
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
        $response = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertStringContainsString("Test power 3", $response);
    }

    public function testCanNotRecreateTheSame(): void
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
        $response = $client->getResponse()->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertStringContainsString("This name already exists.", $response);
        $this->assertStringContainsString("This code already exists.", $response);
    }
}
