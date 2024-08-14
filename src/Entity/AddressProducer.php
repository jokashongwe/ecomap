<?php

namespace App\Entity;

use App\Repository\AddressProducerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: AddressProducerRepository::class)]
class AddressProducer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["producer"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["producer"])]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    #[Groups(["producer"])]
    private ?string $province = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["producer"])]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["producer"])]
    private ?string $territory = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["producer"])]
    private ?string $district = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["producer"])]
    private ?string $sector = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["producer"])]
    private ?string $village = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, Producer>
     */
    #[ORM\OneToMany(targetEntity: Producer::class, mappedBy: 'address')]
    private Collection $producers;

    public function __construct()
    {
        $this->producers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(string $province): static
    {
        $this->province = $province;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getTerritory(): ?string
    {
        return $this->territory;
    }

    public function setTerritory(?string $territory): static
    {
        $this->territory = $territory;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(?string $district): static
    {
        $this->district = $district;

        return $this;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function setSector(?string $sector): static
    {
        $this->sector = $sector;

        return $this;
    }

    public function getVillage(): ?string
    {
        return $this->village;
    }

    public function setVillage(?string $village): static
    {
        $this->village = $village;

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
            $producer->setAddress($this);
        }

        return $this;
    }

    public function removeProducer(Producer $producer): static
    {
        if ($this->producers->removeElement($producer)) {
            // set the owning side to null (unless already changed)
            if ($producer->getAddress() === $this) {
                $producer->setAddress(null);
            }
        }

        return $this;
    }
}
