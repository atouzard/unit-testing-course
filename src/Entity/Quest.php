<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\QuestRepository;

#[ORM\Entity(repositoryClass: QuestRepository::class)]
class Quest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;
    #[ORM\Column]
    private string $name;
    #[ORM\Column]
    private \DateTimeImmutable $startedAt;
    #[ORM\Column(nullable: true, options: ['default' => null])]
    private ?\DateTimeImmutable $endedAt = null;
    #[ORM\Column]
    private bool $finished = false;

    public function __construct(string $name, \DateTimeImmutable $startedAt)
    {
        $this->name = $name;
        $this->startedAt = $startedAt;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStartedAt(): \DateTimeImmutable
    {
        return $this->startedAt;
    }

    public function getEndedAt(): \DateTimeImmutable
    {
        return $this->endedAt;
    }

    public function isFinished(): bool
    {
        return $this->finished;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setStartedAt(\DateTimeImmutable $startedAt): void
    {
        $this->startedAt = $startedAt;
    }

    public function setEndedAt(?\DateTimeImmutable $endedAt): void
    {
        $this->endedAt = $endedAt;
    }

    public function setFinished(bool $finished): void
    {
        $this->finished = $finished;
    }
}