<?php

namespace App\Entity;

use App\Repository\TransformationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransformationRepository::class)]
class Transformation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $process = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sourceProduct = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $restrictions = null;

    #[ORM\Column]
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

    public function getProcess(): ?string
    {
        return $this->process;
    }

    public function setProcess(?string $process): static
    {
        $this->process = $process;

        return $this;
    }

    public function getSourceProduct(): ?string
    {
        return $this->sourceProduct;
    }

    public function setSourceProduct(?string $sourceProduct): static
    {
        $this->sourceProduct = $sourceProduct;

        return $this;
    }

    public function getRestrictions(): ?string
    {
        return $this->restrictions;
    }

    public function setRestrictions(?string $restrictions): static
    {
        $this->restrictions = $restrictions;

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
