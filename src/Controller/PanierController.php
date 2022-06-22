<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Stock;
use SessionIdInterface;
use App\Repository\StockRepository;
use App\Repository\TailleRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[Route('/panier', name: 'panier_')]
class PanierController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, StockRepository $stockRepository): Response
    {
        $panier = $session->get("panier", []);
        
        for ($i = 0; $i < count($panier['lignes']); $i++) {
            $stock = $stockRepository->findBy(array(
                'produit' => $panier['lignes'][$i]['idp'],
                'taille' => $panier['lignes'][$i]['idt'],
            ));
            
            $panier['lignes'][$i]['produit'] = $stock[0]->getProduit();
            $panier['lignes'][$i]['taille'] = $stock[0]->getTaille();
        }

        return $this->render('panier/index.html.twig', [
            'panier' => $panier
        ]);
       
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(Produit $produit, SessionInterface $session): Response
    {
        $idproduit = $produit->getId();//on recupère un produit par son id par la methode get et on stocke dans variable $idproduit
        $idtaille = $_POST['taille'];//on recupère la taille du  produit par son id par la methode get et on stocke dans variable $idproduit
        
        $panier = $session->get('panier', []);
        
        $panier['totalcommande'] = 0;
        $new = 1;
        if (isset($panier['lignes'])) {
           
            $panier['totalcommande'] = 0;
            for ($i = 0; $i < count($panier['lignes']); $i++) {
                if ($panier['lignes'][$i]['idp'] == $idproduit && $panier['lignes'][$i]['idt'] == $idtaille) {
                    $panier['lignes'][$i]['qt']++;
                    $new = 0;
                    $panier['lignes'][$i]['totalligne'] = $produit->getPrix() * $panier['lignes'][$i]['qt'];
                }
            }
        }
        if ($new == 1) {
            $panier['lignes'][] = [
                'idp' => $idproduit,
                'idt' => $idtaille,
                'qt' => 1,
                'prix' => $produit->getPrix(),
                'totalligne' => $produit->getPrix()
            ];
        }  

        //On sauvegarde dans la session PHPSESSID
        
        for ($i = 0; $i < count($panier['lignes']); $i++) {
            $panier['totalcommande'] += $panier['lignes'][$i]['totalligne'];
        }
        $session->set("panier", $panier);

        return $this->redirectToRoute("panier_index");
    }
}
