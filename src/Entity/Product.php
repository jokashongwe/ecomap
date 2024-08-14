<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["producer"])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["producer"])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(["producer"])]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["producer"])]
    private ?string $picture = null;

    #[ORM\Column]
    #[Groups(["producer"])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[Groups(["producer"])]
    private ?TypeProduct $typeProduct = null;

    /**
     * @var Collection<int, Pricing>
     */
    #[ORM\OneToMany(targetEntity: Pricing::class, mappedBy: 'product')]
    private Collection $pricings;

    /**
     * @var Collection<int, Exploitation>
     */
    #[ORM\OneToMany(targetEntity: Exploitation::class, mappedBy: 'product')]
    #[Groups(["producer"])]
    private Collection $exploitations;

    /**
     * @var Collection<int, ProductTransformation>
     */
    #[ORM\OneToMany(targetEntity: ProductTransformation::class, mappedBy: 'product')]
    #[Groups(["producer"])]
    private Collection $productTransformations;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(["producer"])]
    private ?string $sector = null;

    public function __construct()
    {
        $this->pricings = new ArrayCollection();
        $this->exploitations = new ArrayCollection();
        $this->productTransformations = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTypeProduct(): ?TypeProduct
    {
        return $this->typeProduct;
    }

    public function setTypeProduct(?TypeProduct $typeProduct): static
    {
        $this->typeProduct = $typeProduct;

        return $this;
    }

    /**
     * @return Collection<int, Pricing>
     */
    public function getPricings(): Collection
    {
        return $this->pricings;
    }

    public function addPricing(Pricing $pricing): static
    {
        if (!$this->pricings->contains($pricing)) {
            $this->pricings->add($pricing);
            $pricing->setProduct($this);
        }

        return $this;
    }

    public function removePricing(Pricing $pricing): static
    {
        if ($this->pricings->removeElement($pricing)) {
            // set the owning side to null (unless already changed)
            if ($pricing->getProduct() === $this) {
                $pricing->setProduct(null);
            }
        }

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
            $exploitation->setProduct($this);
        }

        return $this;
    }

    public function removeExploitation(Exploitation $exploitation): static
    {
        if ($this->exploitations->removeElement($exploitation)) {
            // set the owning side to null (unless already changed)
            if ($exploitation->getProduct() === $this) {
                $exploitation->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductTransformation>
     */
    public function getProductTransformations(): Collection
    {
        return $this->productTransformations;
    }

    public function addProductTransformation(ProductTransformation $productTransformation): static
    {
        if (!$this->productTransformations->contains($productTransformation)) {
            $this->productTransformations->add($productTransformation);
            $productTransformation->setProduct($this);
        }

        return $this;
    }

    public function removeProductTransformation(ProductTransformation $productTransformation): static
    {
        if ($this->productTransformations->removeElement($productTransformation)) {
            // set the owning side to null (unless already changed)
            if ($productTransformation->getProduct() === $this) {
                $productTransformation->setProduct(null);
            }
        }

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
}
