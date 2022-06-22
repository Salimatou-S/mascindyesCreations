<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecapCommandeController extends AbstractController
{
    #[Route('/recap/commande', name: 'app_recap_commande')]
    public function index(): Response
    {
        return $this->render('recap_commande/index.html.twig', [
            'controller_name' => 'RecapCommandeController',
        ]);
    }
}
