<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findLastProduitsFemme();
        $produits1 = $produitRepository->findLastProduitsFille();
        $produits2 = $produitRepository->findLastProduitsAccessoires();
        
        return $this->render('accueil/index.html.twig', [
            'produits' => $produits,
            'produits1'=>$produits1,
            'produits2'=>$produits2
            
        ]);
    }
}
