<?php

namespace App\Controller\Admin;

use App\Entity\Pricing;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PricingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pricing::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addColumn(8),
            ChoiceField::new('province')
              ->setChoices([
                'Kinshasa' => 'KIN',
                'Kongo-Central' => 'KNC',
                'Kwango' => 'KWG',
                'Kwilu' => 'KWL',
                'Mai-Ndombe' => 'MND'
              ]),
            TextField::new('city', 'Ville'),
            TextField::new('market', 'Marché'),
            NumberField::new('legalPrice', 'Prix Officiel (CDF)'),
            NumberField::new('realPrice', 'Prix sur le marché (CDF)'),
        ];
    }
    
}
