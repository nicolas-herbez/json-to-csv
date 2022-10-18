<?php

namespace App\DataFixtures;

use App\Entity\Power;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PowerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $powers = [
            "Radiation resistance" => "RR",
            "Turning tiny" => "TT",
            "Radiation blast" => "TB",
            "Million tonne punch" => "MTP",
            "Damage resistance" => "DR",
            "Superhuman reflexes" => "SR",
            "Immortality" => "IM",
            "Heat Immunity" => "HI",
            "Inferno" => "IF",
            "Teleportation" => "TEL",
            "Interdimensional travel" => "IT",
            "Cheese Control" => "CC",
            "Drink really fast" => "DRF",
            "Hyper slowing writer" => "HSW",
            "Always late" => "AL",
            "Jump 2 feets up" => "J2F",
            "Never stop jumping" => "NSJ",
            "Cry a lot" => "CAL",
            "Sing to charm" => "STC",
            "Infernal groove" => "IG",
            "Burn all dancfloors" => "BAD",
            "Mortality" => "M",
            "Invisibility" => "INV"
        ];

        foreach ($powers as $key => $value) {
            $power = new Power();

            $power->setName($key);
            $power->setCode($value);

            $manager->persist($power);
        }

        $manager->flush();
    }
}
