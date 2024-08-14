<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\TypeProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = ["Manioc", "Mais", "Canne à Sucre", "Tomates", "Poivron", "Gingembre"];

        foreach ($products as $prod) {
            $product = new Product();
            $product->setName($prod);
            $product->setCreatedAt(new \DateTimeImmutable());
            $product->setDescription("Description Aléatoire");
            $product->setSector("AGRI");
            $manager->persist($product);
        }

        $manager->flush();
    }
}
