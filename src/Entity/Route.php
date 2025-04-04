<?php

namespace App\Entity;

use App\Repository\RouteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RouteRepository::class)]
class Route
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $startPort = null;

    #[ORM\Column(length: 255)]
    private ?string $endPort = null;

    #[ORM\Column(nullable: true)]
    private ?array $WindRiskData = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartPort(): ?string
    {
        return $this->startPort;
    }

    public function setStartPort(string $startPort): static
    {
        $this->startPort = $startPort;

        return $this;
    }

    public function getEndPort(): ?string
    {
        return $this->endPort;
    }

    public function setEndPort(string $endPort): static
    {
        $this->endPort = $endPort;

        return $this;
    }

    public function getWindRiskData(): ?array
    {
        return $this->WindRiskData;
    }

    public function setWindRiskData(?array $WindRiskData): static
    {
        $this->WindRiskData = $WindRiskData;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
