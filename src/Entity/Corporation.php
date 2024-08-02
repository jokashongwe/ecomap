<?php

namespace App\Entity;

use App\Repository\CorporationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CorporationRepository::class)]
class Corporation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $details = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $creationDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endedDate = null;

    #[ORM\Column(nullable: true)]
    private ?bool $hasLegalExistance = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, Exploitation>
     */
    #[ORM\OneToMany(targetEntity: Exploitation::class, mappedBy: 'corporation')]
    private Collection $exploitations;

    /**
     * @var Collection<int, Producer>
     */
    #[ORM\ManyToMany(targetEntity: Producer::class, mappedBy: 'corporations')]
    private Collection $producers;

    public function __construct()
    {
        $this->exploitations = new ArrayCollection();
        $this->producers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): static
    {
        $this->details = $details;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getEndedDate(): ?\DateTimeInterface
    {
        return $this->endedDate;
    }

    public function setEndedDate(?\DateTimeInterface $endedDate): static
    {
        $this->endedDate = $endedDate;

        return $this;
    }

    public function hasLegalExistance(): ?bool
    {
        return $this->hasLegalExistance;
    }

    public function setHasLegalExistance(?bool $hasLegalExistance): static
    {
        $this->hasLegalExistance = $hasLegalExistance;

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

    /**
     * @return Collection<int, Exploitation>
     */
    public function getExploitations(): Collection
    {
        return $this->exploitations;
    }

    public function addExploitation(Exploitation $exploitation): static
    {
        if (!$this->exploitations->contains($exploitation)) {
            $this->exploitations->add($exploitation);
            $exploitation->setCorporation($this);
        }

        return $this;
    }

    public function removeExploitation(Exploitation $exploitation): static
    {
        if ($this->exploitations->removeElement($exploitation)) {
            // set the owning side to null (unless already changed)
            if ($exploitation->getCorporation() === $this) {
                $exploitation->setCorporation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Producer>
     */
    public function getProducers(): Collection
    {
        return $this->producers;
    }

    public function addProducer(Producer $producer): static
    {
        if (!$this->producers->contains($producer)) {
            $this->producers->add($producer);
            $producer->addCorporation($this);
        }

        return $this;
    }

    public function removeProducer(Producer $producer): static
    {
        if ($this->producers->removeElement($producer)) {
            $producer->removeCorporation($this);
        }

        return $this;
    }
}
