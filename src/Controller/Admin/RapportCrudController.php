<?php

namespace App\Controller\Admin;

use App\Entity\Rapport;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RapportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rapport::class;
    }

    
  /*   public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user'),
            AssociationField::new('produit'),
            AssociationField::new('taille'),
         
            MoneyField::new('prix')->setCurrency('EUR')->setStoredAsCents(false),
        ];
    } */
    
}
