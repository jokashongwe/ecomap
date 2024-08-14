<?php

namespace App\Entity;

use App\Repository\ProductionPhaseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ProductionPhaseRepository::class)]
class ProductionPhase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["producer"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["producer"])]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["producer"])]
    private ?string $seedSource = null;

    #[ORM\Column(length: 255)]
    #[Groups(["producer"])]
    private ?string $fertilizer = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["producer"])]
    private ?string $operationnalMode = null;

    #[ORM\ManyToOne(inversedBy: 'productionPhases')]
    #[Groups(["producer"])]
    private ?Exploitation $exploitation = null;

    #[ORM\Column(length: 255)]
    #[Groups(["producer"])]
    private ?string $season = null;

    #[ORM\Column]
    #[Groups(["producer"])]
    private ?int $year = null;

    #[ORM\Column]
    #[Groups(["producer"])]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSeedSource(): ?string
    {
        return $this->seedSource;
    }

    public function setSeedSource(?string $seedSource): static
    {
        $this->seedSource = $seedSource;

        return $this;
    }

    public function getFertilizer(): ?string
    {
        return $this->fertilizer;
    }

    public function setFertilizer(string $fertilizer): static
    {
        $this->fertilizer = $fertilizer;

        return $this;
    }

    public function getOperationnalMode(): ?string
    {
        return $this->operationnalMode;
    }

    public function setOperationnalMode(?string $operationnalMode): static
    {
        $this->operationnalMode = $operationnalMode;

        return $this;
    }

    public function getExploitation(): ?Exploitation
    {
        return $this->exploitation;
    }

    public function setExploitation(?Exploitation $exploitation): static
    {
        $this->exploitation = $exploitation;

        return $this;
    }

    public function getSeason(): ?string
    {
        return $this->season;
    }

    public function setSeason(string $season): static
    {
        $this->season = $season;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

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
