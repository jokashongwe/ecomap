<?php

namespace App\Entity;

use App\Repository\ProductTransformationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductTransformationRepository::class)]
class ProductTransformation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'productTransformations')]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'productTransformations')]
    private ?TransformationPlace $transformationPlace = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $transformationDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $verificationInstitution = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $certification = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $certificationDate = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTransformationPlace(): ?TransformationPlace
    {
        return $this->transformationPlace;
    }

    public function setTransformationPlace(?TransformationPlace $transformationPlace): static
    {
        $this->transformationPlace = $transformationPlace;

        return $this;
    }

    public function getTransformationDate(): ?\DateTimeInterface
    {
        return $this->transformationDate;
    }

    public function setTransformationDate(?\DateTimeInterface $transformationDate): static
    {
        $this->transformationDate = $transformationDate;

        return $this;
    }

    public function getVerificationInstitution(): ?string
    {
        return $this->verificationInstitution;
    }

    public function setVerificationInstitution(?string $verificationInstitution): static
    {
        $this->verificationInstitution = $verificationInstitution;

        return $this;
    }

    public function getCertification(): ?string
    {
        return $this->certification;
    }

    public function setCertification(?string $certification): static
    {
        $this->certification = $certification;

        return $this;
    }

    public function getCertificationDate(): ?\DateTimeInterface
    {
        return $this->certificationDate;
    }

    public function setCertificationDate(?\DateTimeInterface $certificationDate): static
    {
        $this->certificationDate = $certificationDate;

        return $this;
    }
}
