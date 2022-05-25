<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/femme', name: 'page_femme')]
    public function femme(): Response
    {
        return $this->render('page/femme.html.twig', [
            'controller_name' => 'FemmeController',
        ]);
    }

    #[Route('/fille', name: 'page_fille')]
    public function fille(): Response
    {
        return $this->render('page/fille.html.twig', [
            'controller_name' => 'FilleController',
        ]);
    }

    #[Route('/accessoires', name: 'page_accessoires')]
    public function accessoires(): Response
    {
        return $this->render('page/accessoires.html.twig', [
            'controller_name' => 'AccessoiresController',
        ]);
    }
}
