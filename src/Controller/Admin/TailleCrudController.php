<?php

namespace App\Controller\Admin;

use App\Entity\Taille;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TailleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Taille::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('taille'),
            
        ];
    }
    
}
