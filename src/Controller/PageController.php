<?php

namespace App\Controller;

use App\Entity\Taille;
use App\Entity\Produit;
use App\Entity\Category;
use App\Repository\ProduitRepository;
use App\Repository\CategoryRepository;
use App\Repository\TailleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    #[Route('/category/{slug}', name: 'category_parent')]

    public function categoryParent(Category $category, CategoryRepository $categoryRepository): Response
    { /* dd($category); */
        $produits = $categoryRepository->findProduitsByParentCategory($category);

       /*  foreach ($produits as $produits) { */
           /*  dump($produit); 
            
        }*//*  dd(''); */
        return $this->render('page/produits.html.twig', [
                'produits' => $produits,
                'category'=>$category->getName(),
            ]);
    }


    #[Route('/subcategory/category/{slug}', name: 'category_enfant')]
    public function categoryEnfant(Category $category): Response
    {
       /*  dd($category); */
        return $this->render('page/produits.html.twig', [
            'produits' => $category->getproduits(),
            'category'=>$category->getName(),
        ]);
    }

    #[Route('/detail/{slug}', name: 'detail_produit')]
    public function detailProduit(Produit $produit): Response
    { 
        return $this->render('page/detailproduit.html.twig', [
            'produit' => $produit,
          
         ]);
    } 

    #[Route('/construction', name: 'page_construction')]
    public function pageConstruction(): Response
    { 
        return $this->render('page/pageEnConstruction.html.twig');
    } 

    /* #[Route('nouveaux/category/{slug}', name: 'nouveaux_enfant')]
    public function nouveauxCategoryEnfant(Category $category,Produit $produits): Response
    {
       
       dd($produits); 
        return $this->render('test/index.html.twig', [
            'produits' => $category->getproduits(),
            'category'=>$category->getName(),
        ]);
    } */
  
}
