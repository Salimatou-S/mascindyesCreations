<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\StockRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/panier', name: 'panier_')]
class PanierController extends AbstractController
{

    #[Route('/add/{id}', name: 'add')]
    public function add(Produit $produit, SessionInterface $session, Request $request): Response
    {
        $idproduit = $produit->getId();//on recupère un produit par son id par la methode get et on stocke dans variable $idproduit
        /* $idtaille = $_POST['taille']; *///on recupère la taille du  produit par son id par la methode post et on stocke dans variable $idproduit (private)
        $idtaille =$request->get('taille');
        $panier = $session->get('panier', []);//on recupère la session qu'on stocke dans une variable panier.si jamais il n'existe pas il retourne tableau vide
        
        $panier['totalcommande'] = 0; //on initialise le montant total de la commande à 0
        $new = 1;//on part du principe qu'on va créer une ligne dans le panier quand on rajoute un produit. 
        if (isset($panier['lignes'])) {//on verifie si le sous tableau ligne est defini,
            /* $panier['totalcommande'] = 0; */
            for ($i = 0; $i < count($panier['lignes']); $i++) {// on fait une boucle sur les lignes du panier
                if ($panier['lignes'][$i]['idp'] == $idproduit && $panier['lignes'][$i]['idt'] == $idtaille) {
                    $panier['lignes'][$i]['qt']++; //si une ligne existe déjà et que le couple identifiant de la ligne (idp et idt) est identique, on incremente la quantité de 1.
                    $new = 0;//on ne crée donc pas de ligne : new = 0
                    $panier['lignes'][$i]['totalligne'] = $produit->getPrix() * $panier['lignes'][$i]['qt'];// on calcule le montant par ligne de panier
                }
            }
        }//s'il n'existe pas de ligne encore ou si l'identifiant de la ligne à ajouter est differente de la nouvelle (couple (idp - idt) différents): on crée une nouvelle ligne. On sort de la boucle et on passe dans le deuxième if.
        if ($new == 1) {
            $panier['lignes'][] = [// on recupère dans un sous tableau, les infos à recupérer pour créer la ligne.
                'idp' => $idproduit,
                'idt' => $idtaille,
                'qt' => 1,
                'prix' => $produit->getPrix(),
                'totalligne' => $produit->getPrix()
            ];
        }  

       //on va calculer maintenant le montant total de la commande
        
        for ($i = 0; $i < count($panier['lignes']); $i++) {
            $panier['totalcommande'] += $panier['lignes'][$i]['totalligne'];// à chaque tour de boucle, on rajoute au totalcommande la valeur du montant de la ligne [totalligne]
        }
        $session->set("panier", $panier);// on met à jour le panier dans la session

        return $this->redirectToRoute("panier_index");// on redirige vers une route
    }

    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, StockRepository $stockRepository): Response
    {
        $panier = $session->get("panier", []);//on recupère la session qu'on stocke dans une variable panier.

        //on va considérer que le panier est composé de 2 tableaux: un tableau [totalcommande] pour le montant total de la commande et un tableau [lignes] regroupant les lignes de commande. Chaque ligne de commande est considéré comme un sous tableau de [lignes]
        
        for ($i = 0; $i < count($panier['lignes']); $i++) {
            $stock = $stockRepository->findBy(array(// on fait appel au repository stock qui va nous permettre de recuperer la taille du produit
                'produit' => $panier['lignes'][$i]['idp'],
                'taille' => $panier['lignes'][$i]['idt'],
            ));
            
            $panier['lignes'][$i]['produit'] = $stock[0]->getProduit(); //pour chaque ligne de stock, on recupère l'instance du produit
            $panier['lignes'][$i]['taille'] = $stock[0]->getTaille();
        }

        return $this->render('panier/index.html.twig', [
            'panier' => $panier // on transfère à la vue la variable $panier ('panier' est le nom pris dans twig)
        ]);
    } 
    
    #[Route('/panier/remove/{id}', name:'remove')]
    public function remove (Produit $produit, SessionInterface $session, Request $request){
        $idproduit = $produit->getId();
        $idtaille =$request->get('taille');
        $panier = $session->get('panier', []);
            for ($i = 0; $i < count($panier['lignes']); $i++) {
                if ($panier['lignes'][$i]['idp'] == $idproduit && $panier['lignes'][$i]['idt'] == $idtaille) {
                    unset($panier['lignes'][$i]);
            }
            $session->remove("panier");
            $session->set("panier", $panier);
            return $this->redirectToRoute("panier_index");
        }
    } 
}
