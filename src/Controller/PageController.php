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

    #[Route('/femmewax', name: 'femme_wax')]
    public function femmewax(): Response
    {
        return $this->render('page/femmewax.html.twig', [
            'controller_name' => 'FemmewaxController',
        ]);
    }

    #[Route('/femmebazin', name: 'femme_bazin')]
    public function femmebazin(): Response
    {
        return $this->render('page/femmebazin.html.twig', [
            'controller_name' => 'FemmebazinController',
        ]);
    }

    #[Route('/fille', name: 'page_fille')]
    public function fille(): Response
    {
        return $this->render('page/fille.html.twig', [
            'controller_name' => 'FilleController',
        ]);
    }

    #[Route('/fillebazin', name: 'fille_bazin')]
    public function fillebazin(): Response
    {
        return $this->render('page/fillebazin.html.twig', [
            'controller_name' => 'FillebazinController',
        ]);
    }

    #[Route('/fillewax', name: 'fille_wax')]
    public function fillewax(): Response
    {
        return $this->render('page/fillewax.html.twig', [
            'controller_name' => 'FillewaxController',
        ]);
    }

    #[Route('/accessoires', name: 'page_accessoires')]
    public function accessoires(): Response
    {
        return $this->render('page/accessoires.html.twig', [
            'controller_name' => 'AccessoiresController',
        ]);
    }

    #[Route('/accessoiresSC', name: 'accessoires_SC')]
    public function accessoiresSC(): Response
    {
        return $this->render('page/accessoiresSC.html.twig', [
            'controller_name' => 'AccessoiresSCController',
        ]);
    }

    #[Route('/accessoiresBJ', name: 'accessoires_BJ')]
    public function accessoiresBJ(): Response
    {
        return $this->render('page/accessoiresBJ.html.twig', [
            'controller_name' => 'AccessoiresBJController',
        ]);
    }
}
