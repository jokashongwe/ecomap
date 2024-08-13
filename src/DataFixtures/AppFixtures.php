<?php

namespace App\DataFixtures;

use App\Entity\TypeProduct;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $t1 = new TypeProduct();
        $t1->setName('Produit Brut');

        $t2 = new TypeProduct();
        $t2->setName('Produit Fini');

        $t3 = new TypeProduct();
        $t3->setName('Intrant');
        
        
        $manager->persist($t1);
        $manager->persist($t2);
        $manager->persist($t3);

        $manager->flush();
    }
}
