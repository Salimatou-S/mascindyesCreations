<?php

namespace App\Controller;

use App\Entity\Rapport;
use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\ProduitRepository;
use App\Repository\TailleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(Request $request, TailleRepository $tailleRepository, ProduitRepository $produitRepository, ManagerRegistry $doctrine, SessionInterface $session): Response
    {
        $user = $this->getUser();//on recupere le user connecté qu'on stocke dans la variable user
        $form = $this->createForm(CommandeType::class, $user);//on relie le formulaire au user
        $form->handleRequest($request); //inspecte la requête et appelle le lien si soumission
        if ($form->isSubmitted() && $form->isValid()) {//si le formulaire est soumis et est valide
            $em = $doctrine->getManager(); //on recupère le manager de doctrine
            
            $commande = new Commande();//on fait appel à une nouvelle instance de commande
            $commande->setUser($user);//on relie la commande au user

            $panier = $session->get('panier');//on recupère le panier
            $commande->setMontantTTc($panier['totalcommande']);//on stocke le montant total de la commade dans un variable
            $em ->persist($commande);//on persist la commande dans la base

            foreach ($panier['lignes'] as $ligne) {// on parcourt les lignes du panier et on recupère à chaque tour de boucle toutes les infos d'une ligne. 
                $rapport= new Rapport();//on va créer autant d'instances que necessaire dans la table de jointure Rapport et chaque instance doit pointer vers produit et vers commande. L'id est autoincrémenté. Il faut le produit_id. On va hydrater l'instance. Dans chaque propriété, il faut une valeur.
                $produit= $produitRepository->find($ligne['idp']);//on va recuperer l'instance du produit grâce à l'identifiant qui est dans la ligne du panier 
                $rapport->setProduit($produit);//on va relier l'instance de produit avec l'instance de rapport
                $rapport->setCommande($commande);//
                $rapport->setQuantite($ligne['qt']);//on recupère la quantité qui vient du panier et on l'affecte à linstance rapport
                $rapport->setPrix($ligne['prix']);//on recupère le prix
                $taille= $tailleRepository->find($ligne['idt']);//Comme c'est une relation, on retrouve l'instance de la taille pour pouvoir l'associer à la relation.
                $rapport->setTaille($taille);

                $em ->persist($rapport);//on persiste à chaque tour de boucle 
            }
            $em->flush(); //va faire toutes les requêtes insert
            $session->remove('panier');
           /*  dd($commande->getRapports());  */
            return $this->render('recap_commande/index.html.twig', [
                'commande' => $commande,
                'rapport'=>$rapport 
                 
            ]);
        }
        return $this->render('commande/index.html.twig', [
            'commandeform' => $form->createView(),
        ]);
    }

   /*  #[Route('/test/{id}', name: 'app_test')]
    public function test(Commande $commande): Response
    {
        foreach ($commande->getRapports() as $rapport) {
            dd($rapport);
        }
        
    } */
}
