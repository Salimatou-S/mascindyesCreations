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
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class ProduitCrudController extends AbstractCrudController
{
    /* public const BASE_PATH= 'mascindye/images'; */
    public const UPLOAD_DIR= 'public/mascindye/images';

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
            ImageField::new('url_image')
                /* ->setBasePath(self::BASE_PATH) */
                ->setUploadDir(self::UPLOAD_DIR),
            TextField::new('description')->onlyOnForms(),
            MoneyField::new('prix_TTC')->setCurrency('EUR'),
            BooleanField::new('active')->hideWhenCreating(),
        
        ];
    }
   
}
