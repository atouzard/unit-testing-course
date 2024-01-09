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
    private ?string $status = null;

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
        return match ($this->health) {
            15 => 'Good',
            0 => 'Dead',
            default => 'Wounded',
        };
    }

    public function setStatus(?string $newStatus): self
    {
        $this->status = $newStatus;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function isAvailable(): bool
    {
        if ($this->health === 0) {
            return false;
        }
        if ($this->status === 'ready' || $this->status === null) {
            return true;
        }
        return false;
    }
}
