<?php

namespace App\Entity;

use App\Repository\ProducerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProducerRepository::class)]
class Producer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $middlename = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(length: 20)]
    private ?string $gender = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'producers')]
    private ?AddressProducer $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bankAcount = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberOfChildren = null;

    #[ORM\Column(length: 255)]
    private ?string $maritalStatus = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $handicap = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $averageMonthIncome = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, Corporation>
     */
    #[ORM\ManyToMany(targetEntity: Corporation::class, inversedBy: 'producers')]
    private Collection $corporations;

    public function __construct()
    {
        $this->corporations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getMiddlename(): ?string
    {
        return $this->middlename;
    }

    public function setMiddlename(?string $middlename): static
    {
        $this->middlename = $middlename;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): static
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): static
    {
        $this->gender = $gender;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?AddressProducer
    {
        return $this->address;
    }

    public function setAddress(?AddressProducer $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getBankAcount(): ?string
    {
        return $this->bankAcount;
    }

    public function setBankAcount(?string $bankAcount): static
    {
        $this->bankAcount = $bankAcount;

        return $this;
    }

    public function getNumberOfChildren(): ?int
    {
        return $this->numberOfChildren;
    }

    public function setNumberOfChildren(?int $numberOfChildren): static
    {
        $this->numberOfChildren = $numberOfChildren;

        return $this;
    }

    public function getMaritalStatus(): ?string
    {
        return $this->maritalStatus;
    }

    public function setMaritalStatus(string $maritalStatus): static
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    public function getHandicap(): ?string
    {
        return $this->handicap;
    }

    public function setHandicap(?string $handicap): static
    {
        $this->handicap = $handicap;

        return $this;
    }

    public function getAverageMonthIncome(): ?string
    {
        return $this->averageMonthIncome;
    }

    public function setAverageMonthIncome(?string $averageMonthIncome): static
    {
        $this->averageMonthIncome = $averageMonthIncome;

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
     * @return Collection<int, Corporation>
     */
    public function getCorporations(): Collection
    {
        return $this->corporations;
    }

    public function addCorporation(Corporation $corporation): static
    {
        if (!$this->corporations->contains($corporation)) {
            $this->corporations->add($corporation);
        }

        return $this;
    }

    public function removeCorporation(Corporation $corporation): static
    {
        $this->corporations->removeElement($corporation);

        return $this;
    }
}
