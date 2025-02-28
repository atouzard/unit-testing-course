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
    #[ORM\Column]
    private int $xp;
    #[ORM\Column(enumType: AdventurerStatus::class)]
    private ?AdventurerStatus $status = null;

    public function __construct(
        string $name,
        string $class = 'Unknown',
        int    $health = 0,
        int    $xp = 0
    )
    {
        $this->name = $name;
        $this->class = $class;
        $this->health = $health;
        $this->xp = $xp;
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

    public function getXp(): int
    {
        return $this->xp;
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
        }

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

    public function heal(int $health): void
    {
        if ($this->health == 0 || $this->health < 0) {
            $this->health = 0;
            return;
        }

        $this->health = $health + $this->health;

        if ($this->health > 20) {
            $this->health = 20;
        } else if ($this->health < 0) {
            $this->health = 0;
        }
    }

    public function addXp(int $xp): void
    {
        $newXp = $this->getXp() + $xp;

        $this->xp = $newXp;
    }

    public function getLevel(): int
    {
        if ($this->xp < 0) {
            $this->xp = 0;
        }

        $lvl = $this->xp / 1000 + 1;

        if ($lvl > 20) {
            return 20;
        }

        return floor($lvl);
    }

    public function getLevelAdvancementPercentage(): int
    {
        return ($this->xp % 1000) / 10;
    }
}
