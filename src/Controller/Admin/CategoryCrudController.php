<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            /* IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
 */
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('created_at')->hideWhenCreating(),
            /* DateTimeField::new('updated_at')->hideWhenUpdating(), */
            TextField::new('name'),
            AssociationField::new('parent'),
            BooleanField::new('active')/* ->hideWhenCreating() */,
        
        ];
    }
   
}
