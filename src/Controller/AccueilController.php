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
        $femmeWax = $produitRepository->findLastProduitsFemmeWax();
        $femmeBazin = $produitRepository->findLastProduitsFemmeBazin();
        $filleWax = $produitRepository->findLastProduitsFilleWax();
        $filleBazin = $produitRepository->findLastProduitsFilleBazin();
        $sac = $produitRepository->findLastProduitsSac();
        $bijou = $produitRepository->findLastProduitsBijou();
        
        return $this->render('accueil/index.html.twig', [
            'femmeWax' => $femmeWax,
            'femmeBazin'=>$femmeBazin,
            'filleWax'=>$filleWax,
            'filleBazin'=>$filleBazin,
            'sac'=>$sac,
            'bijou'=>$bijou,
        ]);
    }
}
//serializer: transformer les infos dans une variable php en j.son