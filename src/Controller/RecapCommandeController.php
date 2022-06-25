<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Rapport;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecapCommandeController extends AbstractController
{
    #[Route('/recap/commande', name: 'app_recap_commande')]
    public function index( /* Rapport $rapport, Commande $commande */): Response
    {
        /* $commande =new Commande();
        $commande->getId() */
      
        /* $commande ->setMontantTTc();
        $commande-> */


        

       
        
       
        return $this->render('recap_commande/index.html.twig', [
            'controller_name' => 'RecapCommandeController',
        ]);
    }
}
