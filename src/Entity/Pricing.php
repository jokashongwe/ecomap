<?php

namespace App\Entity;

use App\Repository\PricingRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PricingRepository::class)]
class Pricing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $legalPrice = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $realPrice = null;

    #[ORM\Column(length: 255)]
    private ?string $province = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $market = null;

    #[ORM\ManyToOne(inversedBy: 'pricings')]
    private ?Product $product = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLegalPrice(): ?string
    {
        return $this->legalPrice;
    }

    public function setLegalPrice(string $legalPrice): static
    {
        $this->legalPrice = $legalPrice;

        return $this;
    }

    public function getRealPrice(): ?string
    {
        return $this->realPrice;
    }

    public function setRealPrice(string $realPrice): static
    {
        $this->realPrice = $realPrice;

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

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getMarket(): ?string
    {
        return $this->market;
    }

    public function setMarket(?string $market): static
    {
        $this->market = $market;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
    }
}
