<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamsTest extends WebTestCase
{
    public function testCreateCsv(): void
    {
        $newTeam = '
            {
                "teams" : [
                    {
                        "squadName": "squadName",
                        "homeTown": "homeTown",
                        "formed": 1997,
                        "secretBase": "secretBase",
                        "active": true,
                        "members": [
                            {
                                "name": "name",
                                "age": 18,
                                "secretIdentity": "secretIdentity",
                                "powers": [
                                    "power"
                                ]
                            }
                        ]
                    }
                ]
            }
        ';

        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/api/teams',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $newTeam
        );

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/vnd.ms-excel');
    }

    public function testCreateCsvWithoutMember(): void
    {
        $newTeam = '
            {
                "teams" : [
                    {
                        "squadName": "squadName",
                        "homeTown": "homeTown",
                        "formed": 1997,
                        "secretBase": "secretBase",
                        "active": true,
                        "members": []
                    }
                ]
            }
        ';

        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/api/teams',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $newTeam
        );

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/vnd.ms-excel');
    }
}
