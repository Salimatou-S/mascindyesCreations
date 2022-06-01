<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use Symfony\Component\Notifier\Texter;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            /* IdField::new('id'),
            TextField::new('nom'),
            TextEditorField::new('description'), */
            

            IdField::new('id')->hideOnForm(),
            DateTimeField::new('created_at')->hideWhenCreating(),
            TextField::new('nom'),
            AssociationField::new('category'),
            AssociationField::new('fournisseur'),
            ImageField::new('url_image')->hideOnForm(),
            TextField::new('description')->onlyOnForms(),
            BooleanField::new('active')->hideWhenCreating(),
        
        ];
    }
   
}
