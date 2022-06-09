<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ProduitRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    #[Route('/{slug}', name: 'category_parent')]

    public function index4(Category $category, CategoryRepository $categoryRepository): Response
    { /* dd($category); */
        $produits = $categoryRepository->findProduitsByParentCategory($category);

        foreach ($produits as $produit) {
           /*  dump($produit); */
            
        }/*  dd(''); */
        return $this->render('page/produits.html.twig', [
                'produits' => $produits,
                'category'=>$category->getName(),
            ]);
    }


    #[Route('/category/{slug}', name: 'category_enfant')]
    public function categoryEnfant(Category $category, CategoryRepository $categoryRepository): Response
    {
       /*  dd($category); */
        return $this->render('page/produits.html.twig', [
            'produits' => $category->getproduits(),
            'category'=>$category->getName(),
        ]);
    }

   /*  #[Route('/femmebazin', name: 'femme_bazin')]
    public function femmebazin(ProduitRepository $produitRepository): Response
    {
        $produits =$produitRepository->femmeBazin();
        return $this->render('page/femmebazin.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/fille', name: 'page_fille')]
    public function fille(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->collectionFille();
        return $this->render('page/fille.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/fillebazin', name: 'fille_bazin')]
    public function fillebazin(): Response
    {
        return $this->render('page/fillebazin.html.twig', [
            'controller_name' => 'FillebazinController',
        ]);
    }

    #[Route('/fillewax', name: 'fille_wax')]
    public function fillewax(): Response
    {
        return $this->render('page/fillewax.html.twig', [
            'controller_name' => 'FillewaxController',
        ]);
    }

    #[Route('/accessoires', name: 'page_accessoires')]
    public function accessoires(): Response
    {
        return $this->render('page/accessoires.html.twig', [
            'controller_name' => 'AccessoiresController',
        ]);
    }

    #[Route('/accessoiresSC', name: 'accessoires_SC')]
    public function accessoiresSC(): Response
    {
        return $this->render('page/accessoiresSC.html.twig', [
            'controller_name' => 'AccessoiresSCController',
        ]);
    }

    #[Route('/accessoiresBJ', name: 'accessoires_BJ')]
    public function accessoiresBJ(): Response
    {
        return $this->render('page/accessoiresBJ.html.twig', [
            'controller_name' => 'AccessoiresBJController',
        ]);
    } */
}
