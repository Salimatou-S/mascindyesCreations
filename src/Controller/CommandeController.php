<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\CommandeType;
use App\Repository\ProduitRepository;
use App\Repository\RapportRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CommandeController extends AbstractController
{
    #[Route('/commande', name: 'app_commande')]
    public function index(Request $request, ManagerRegistry $doctrine, ProduitRepository $produitRepository, SessionInterface $session,RapportRepository $rapportRepository): Response
    {
        $commande= new Commande ();
        $form= $this->createForm(CommandeType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $commande->setUser($this->getUser());
            $em=$doctrine->getManager();
            $em ->persist($commande);
            dd($commande);
            $em->flush();

            $panier = $session->get('panier', []);
            /* dd($panier); */
            $datapanier=[];

        // $panier=$session->get('panier',[]);
        // foreach ($panier as $idp=>$panier){
        //     $rapport=$rapportRepository->findBy($idp);
        //     dd($rapport);
        //}

        }
        return $this->render('commande/index.html.twig', [
            'commandeform' => $form->createView(),
        ]);
    }
}
