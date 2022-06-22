<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProduitRepository $produitRepository): Response
    {
        $produits = $produitRepository->findLastProduitsFemme();
        $produits1 = $produitRepository->findLastProduitsFille();
        return $this->render('test/index.html.twig', [
            'produits' => $produits,
            'produits1'=>$produits1
        ]);
    }
}
