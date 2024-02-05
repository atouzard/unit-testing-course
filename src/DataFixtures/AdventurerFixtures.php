<?php

namespace App\DataFixtures;

use App\Entity\Adventurer;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdventurerFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher,
    )
    {
    }

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

        $user = new User('admin');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'admin'));
        $manager->persist($user);

        $manager->flush();
    }
}
