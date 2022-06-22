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
        $user = $this->getUser();
        $form = $this->createForm(CommandeType::class, $user);
        $form->handleRequest($request); //inspecte la requête et appelle le lien si soumission
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            
            $commande = new Commande();
            $commande->setUser($user);

            $panier = $session->get('panier');
            $commande->setMontantTTc($panier['totalcommande']);
            $em ->persist($commande);

            foreach ($panier['lignes'] as $ligne) {
                $rapport= new Rapport();
                $produit= $produitRepository->find($ligne['idp']);
                $rapport->setProduit($produit);
                $rapport->setCommande($commande);
                $rapport->setQuantite($ligne['qt']);
                $rapport->setPrix($ligne['prix']);
                $taille= $tailleRepository->find($ligne['idt']);
                $rapport->setTaille($taille);

                $em ->persist($rapport);
            }
           $em->flush();
           return $this->redirectToRoute('home');
        }
        return $this->render('commande/index.html.twig', [
            'commandeform' => $form->createView(),
        ]);
    }
}
