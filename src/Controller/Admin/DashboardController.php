<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Stock;
use App\Entity\Taille;
use App\Entity\Produit;
use App\Entity\Category;
use App\Entity\Commande;
use App\Entity\Fournisseur;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ProduitCrudController;
use App\Entity\Commentaire;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProduitCrudController::class)->generateUrl());
        

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MascindyesCreations');
           
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('E-commerce');
        yield MenuItem::linktoRoute('Retour au site', 'fas fa-home', 'home'); 

        yield MenuItem::subMenu('Produits','fas fa-store')
        ->setSubItems([
            MenuItem::linkToCrud('Ajouter produit','fas fa-plus',Produit::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir produits','fas fa-eye',Produit::class),
        ]);

        yield MenuItem::subMenu('Categories','fa fa-tags')
        ->setSubItems([
            MenuItem::linkToCrud('Ajouter Categorie','fas fa-plus',Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir categories','fas fa-eye',Category::class),
        ]);

        yield MenuItem::subMenu('Fournisseurs','fas fa-list')
        ->setSubItems([
            MenuItem::linkToCrud('Ajouter Fournisseur','fas fa-plus',Fournisseur::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir Fournisseurs','fas fa-eye',Fournisseur::class),
        ]);
        
        yield MenuItem::subMenu('Taille','fas fa-list')
        ->setSubItems([
            MenuItem::linkToCrud('Ajouter taille','fas fa-plus',Taille::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir taille','fas fa-eye',Taille::class),
        ]);

        yield MenuItem::subMenu('User','fas fa-list')
        ->setPermission('ROLE_ADMIN')
        ->setSubItems ([
            MenuItem::linkToCrud('Ajouter user','fas fa-plus',User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir user','fas fa-eye',User::class),            
        ]);

        yield MenuItem::subMenu('stock','fas fa-list')
        ->setSubItems([
            MenuItem::linkToCrud('Ajouter stock','fas fa-plus',Stock::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir stocks','fas fa-eye',Stock::class),
        ]);

        yield MenuItem::subMenu('commande','fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Voir commande','fas fa-eye',Commande::class),
        ]);

        yield MenuItem::subMenu('commentaire','fas fa-list')
        ->setPermission("ROLE_ADMIN","ROLE_MODERATEUR")
        ->setSubItems([
            MenuItem::linkToCrud('Voir commentaire','fas fa-eye',Commentaire::class),
        ]);


       /*  yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Produits', 'fas fa-list', Produit::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class); 
        yield MenuItem::linkToCrud('Fournisseur', 'fas fa-list', Fournisseur::class); */ 
        //yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
