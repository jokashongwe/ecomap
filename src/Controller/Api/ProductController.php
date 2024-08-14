<?php

namespace App\Controller\Api;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


class ProductController extends AbstractController
{
    #[Route('/api/v1/products', name: 'app_products', methods: ['GET'])]
    public function create(ProductRepository $productRepository)
    {
        return $this->json(["data" => $productRepository->findAll()]);
    }
}
