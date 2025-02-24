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
    #[ORM\Column(enumType: AdventurerStatus::class)]
    private ?AdventurerStatus $status = null;

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

    public function getHealthDescription(): string
    {
        if ($this->health >= 15) {
            return 'fine';
        }

        if ($this->health > 5) {
            return 'wounded';
        }

        if ($this->health > 0) {
            return 'badly wounded';
        }

        return 'dead';
    }

    public function isAvailable(): bool
    {
        if ($this->health < 10) {
            return false;
        }

        if ($this->status === AdventurerStatus::POISONED) {
            return false;
        }

        if ($this->status === AdventurerStatus::SLEEPING) {
            return false;
        }

        if ($this->status === AdventurerStatus::EATING) {
            return false;
        }

        if ($this->status === AdventurerStatus::UNAVAILABLE) {
            return false;
        }gl

        if ($this->status === AdventurerStatus::SICK) {
            return false;
        }

        return true;
    }

    public function setStatus(AdventurerStatus $status): void
    {
        $this->status = $status;
    }

    public function getStatus(): ?AdventurerStatus
    {
        return $this->status;
    }

    public function getDescription(): string
    {
        return sprintf('Nom : %s, Class : %s, HP : %d', $this->name, $this->class, $this->health);
    }
}
