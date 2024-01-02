<?php

namespace App\Entity;

use App\Repository\AdventurerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdventurerRepository::class)]
class Adventurer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;
    #[ORM\Column]
    private string $name;
    #[ORM\Column]
    private string $class;
    #[ORM\Column]
    private int $health;

    public function __construct(
        string $name,
        string $class = 'Unknown',
        int $health = 0
    )
    {
        $this->name = $name;
        $this->class = $class;
        $this->health = $health;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getHealth(): int
    {
        return $this->health;
    }
}
