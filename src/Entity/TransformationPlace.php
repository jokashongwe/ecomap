<?php

namespace App\Entity;

use App\Repository\TransformationPlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransformationPlaceRepository::class)]
class TransformationPlace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $company = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $province = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    /**
     * @var Collection<int, ProductTransformation>
     */
    #[ORM\OneToMany(targetEntity: ProductTransformation::class, mappedBy: 'transformationPlace')]
    private Collection $productTransformations;

    public function __construct()
    {
        $this->productTransformations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
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

    public function setProvince(?string $province): static
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
            $productTransformation->setTransformationPlace($this);
        }

        return $this;
    }

    public function removeProductTransformation(ProductTransformation $productTransformation): static
    {
        if ($this->productTransformations->removeElement($productTransformation)) {
            // set the owning side to null (unless already changed)
            if ($productTransformation->getTransformationPlace() === $this) {
                $productTransformation->setTransformationPlace(null);
            }
        }

        return $this;
    }
}
