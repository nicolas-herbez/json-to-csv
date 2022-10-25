<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamMembersTest extends WebTestCase
{
    public function testCreateCsv(): void
    {
        $newTeamMembers = '
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
                                    "Test power 2"
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
            '/api/team-members',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $newTeamMembers
        );

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/vnd.ms-excel');
    }

    public function testCreateCsvWithoutMember(): void
    {
        $newTeamMembers = '
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
                                "powers": false
                            }
                        ]
                    }
                ]
            }
        ';

        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/api/team-members',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $newTeamMembers
        );

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/vnd.ms-excel');
    }
}
