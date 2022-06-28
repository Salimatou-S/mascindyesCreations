<?php

namespace App\Controller;

/* use App\Entity\Taille; */
use App\Entity\Produit;
use App\Entity\Category;
/* use App\Repository\TailleRepository;*/
use App\Entity\Commentaire; 
use App\Form\CommentaireType;
/* use App\Repository\ProduitRepository;  */
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
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
    public function detailProduit(Produit $produit, Request $request, ManagerRegistry $doctrine ): Response
    { 
        $commentaire=new Commentaire();
        $form =$this->createForm(CommentaireType::class, $commentaire);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $commentaire->setUser($this->getUser());
            $commentaire->setProduit($produit);
            $em=$doctrine->getManager();
            $em->persist($commentaire);
            $em->flush(); 
            return $this->redirectToRoute('detail_produit', array('slug' => $produit->getSlug()));
        }
        return $this->render('page/detailproduit.html.twig', [
            'produit' => $produit,
            'commentaire'=>$commentaire,
            'form'=>$form->createView(),
            
         ]);
    } 

    #[Route('/construction', name: 'page_construction')]
    public function pageConstruction(): Response
    { 
        return $this->render('page/pageEnConstruction.html.twig');
    } 
}
