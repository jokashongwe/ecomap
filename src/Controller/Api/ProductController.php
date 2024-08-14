<?php

namespace App\Controller\Api;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ProductController extends AbstractController
{
    #[Route('/api/v1/products', name: 'app_products', methods: ['GET'])]
    public function create(ProductRepository $productRepository, SerializerInterface $serializer)
    {
        return $this->json(["data" => json_decode($serializer->serialize($productRepository->findAll(), 'json', ['groups' => ['product']])) ]);
    }
}
