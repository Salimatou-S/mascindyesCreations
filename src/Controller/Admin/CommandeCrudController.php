<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
          
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user'),
           /*  AssociationField::new('produits'), */
           /*  AssociationField::new('rapport'), */
           /*  AssociationField::new('tailles'), */ 
            MoneyField::new('montant_TTc')->setCurrency('EUR')->setStoredAsCents(false),
            
        ];
    }
    
}
