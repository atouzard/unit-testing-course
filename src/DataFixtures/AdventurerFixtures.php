<?php

namespace App\DataFixtures;

use App\Entity\Adventurer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdventurerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $adventurers = [
            new Adventurer('Anne', 'Cleric', 2),
            new Adventurer('Pierre','Ranger', 7),
            new Adventurer('Dartagnan', 'Swashbuckler', 15),
            new Adventurer('Dennis', 'Paladin', 6),
            new Adventurer('Jeanne', 'Fighter', 10),
        ];

        foreach ($adventurers as $adventurer) {
            $manager->persist($adventurer);
        }

        $manager->flush();
    }
}
