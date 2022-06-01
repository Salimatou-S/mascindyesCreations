<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ProduitCrudController;
use App\Entity\Fournisseur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Routing\Annotation\Route;
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

        yield MenuItem::subMenu('Produits','fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Ajouter produit','fas fa-plus',Produit::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir produits','fas fa-eye',Produit::class),
        ]);

        yield MenuItem::subMenu('Categories','fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Ajouter Categorie','fas fa-plus',Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir categories','fas fa-eye',Category::class),
        ]);

        yield MenuItem::subMenu('Fournisseurs','fas fa-list')->setSubItems([
            MenuItem::linkToCrud('Ajouter Categorie','fas fa-plus',Fournisseur::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir categories','fas fa-eye',Fournisseur::class),
        ]);
        


       /*  yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Produits', 'fas fa-list', Produit::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class); 
        yield MenuItem::linkToCrud('Fournisseur', 'fas fa-list', Fournisseur::class); */ 
        //yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
