<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Produits') ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom'),
            TextEditorField::new('description'),
            ImageField::new('picture', 'Image')
                ->setUploadDir('public/products')
                ->setBasePath('products/'),
            ChoiceField::new('sector', 'Secteur')
                ->setChoices([
                    'Agricole' => 'AGRI',
                    // 'Elevage'  => 'ELEVAGE',
                    // 'Mine'     => 'MINE'
                ]),
            AssociationField::new('typeProduct', 'Type de Produit')->autocomplete(),
            CollectionField::new('pricings', 'Informations sur les Prix')->useEntryCrudForm(),
            CollectionField::new('productTransformations', 'Transformations')->useEntryCrudForm()
        ];
    }
    
}
