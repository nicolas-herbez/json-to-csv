<?php

use App\DataFixtures\PowerFixtures;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PowerFixturesTest extends WebTestCase
{
    /** @var AbstractDatabaseTool */
    protected $databaseTool;

    public function setUp(): void
    {
        parent::setUp();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testLoadFixtures()
    {
        $this->databaseTool->loadFixtures([
            PowerFixtures::class
        ]);

        $this->assertEquals(true, true);
    }

    // protected function tearDown(): void
    // {
    //     parent::tearDown();
    //     unset($this->databaseTool);
    // }
}
