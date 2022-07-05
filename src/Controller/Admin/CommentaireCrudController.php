<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateTimeField::new('created_at'),
            AssociationField::new('user'),
            TextField::new('contenu'),
            AssociationField::new('produit'), 
        ];
    }
   

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        // ...
        // this will forbid to create or delete entities in the backend
        ->disable(Action::NEW, Action::EDIT )//desactiver la creation d'un commentaire par le moderateur
    ;
    }
}
