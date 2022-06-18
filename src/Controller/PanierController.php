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
        $panier=$session->get("panier",[]);

        //On "fabrique" les données: recuperer le produit correspondant à cahcune des lignes du panier
        $dataPanier=[];//variable que j'initialise en un tableau vide
        $total=0;//total des prix
       

        for($i=0; $i< count($panier); $i++ ){
            dump($panier[$i]);
            $stock =$stockRepository->findBy(array(
                'produit'=>$panier[$i]['idp'],
                'taille'=>$panier[$i]['idt'],
            ));
           /*  dd($stock[0]); */
            $panier[$i]['produit']=$stock[0]->getProduit();
            $panier[$i]['taille']=$stock[0]->getTaille();
           
         }
           
         dump($panier);
        /*  dd(''); */
       /*  foreach($panier as $id =>$quantite){
            $produit =$produitRepository->find($id);
            $dataPanier[]=[
                "produit"=>$produit,
                "quantite"=>$quantite,
            ];
            $total += $produit->getPrix()* $quantite;
        } */
        return $this->render('panier/index.html.twig',[
            'panier'=>$panier
        ]);
       /*  return $this->render('panier/index.html.twig',compact("dataPanier","total")); */
    }

    #[Route('/add/{id}', name: 'add')]
    public function add(Produit $produit, SessionInterface $session): Response
    {
       
        $idproduit=$produit->getId();
        $idtaille=$_POST['taille'];
       /*  dump($idtaille); */
        //Recuperer le panier en cours
        $panier=$session->get('panier',[]);
        $new=1;
        for($i=0; $i < count($panier); $i++){
           if($panier[$i]['idp']==$idproduit && $panier[$i]['idt']==$idtaille){
            $panier[$i]['qt']++;
            $new=0;
           }
        }   
        if ($new==1){ 
            $panier[]=[
                'idp'=>$idproduit,
                'idt'=>$idtaille,
                'qt'=>1
            ];
        }  
         //On sauvegarde dans la session PHPSESSID
         $session->set("panier",$panier);
        
      
       
        /* dd($session); */
        return $this->redirectToRoute("panier_index");

    }
}