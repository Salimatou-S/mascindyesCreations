<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use SessionIdInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/panier', name: 'panier_')]
class PanierController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $panier=$session ->get("panier",[]);

        //On "fabrique" les données: recuperer le produit correspondant à cahcune des lignes du panier
        $dataPanier=[];//variable que j'initialise en un tableau vide
        $total=0;//total des prix
        $fraisport=0;
        foreach($panier as $id =>$quantite){
            $produit =$produitRepository->find($id);
            $dataPanier[]=[
                "produit"=>$produit,
                "quantite"=>$quantite,
            ];
            $total += $produit->getPrix()* $quantite;
        }
        
        return $this->render('panier/index.html.twig',compact("dataPanier","total"));
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(Produit $produit, SessionInterface $session): Response
    {
        //Recuperer le panier en cours
        $panier=$session->get('panier',[]);
        $id=$produit->getId();

        if (!empty($panier[$id])){
            $panier[$id]++;
        }else{
            $panier[$id]=1;
        }

        //On sauvegarde dans la session PHPSESSID
        $session->set("panier",$panier);
        /* dd($session); */
        return $this->redirectToRoute("panier_index");

    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Produit $produit, SessionInterface $session): Response
    {
        //Recuperer le panier en cours
        $panier=$session->get('panier',[]);
        $id=$produit->getId();

        if (!empty($panier[$id])){
            if($panier[$id]>1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }

        //On sauvegarde dans la session PHPSESSID
        $session->set("panier",$panier);
        /* dd($session); */
        return $this->redirectToRoute("panier_index");
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Produit $produit, SessionInterface $session): Response
    {
        //Recuperer le panier en cours
        $panier=$session->get('panier',[]);
        $id=$produit->getId();

        if (!empty($panier[$id])){
            unset($panier[$id]);//retirer la ligne
        }

        //On sauvegarde dans la session PHPSESSID
        $session->set("panier",$panier);
        /* dd($session); */
        return $this->redirectToRoute("panier_index");
    }

    #[Route('/delete', name: 'delete_all')]
    public function deleteAll(SessionInterface $session): Response
    {
        $session->remove("panier");
       // l'autre option: $session->set("panier",[]);

        /* dd($session); */
        return $this->redirectToRoute("panier_index");
    }
}
