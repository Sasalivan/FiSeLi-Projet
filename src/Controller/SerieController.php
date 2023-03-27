<?php

namespace App\Controller;

use App\Form\SerieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerieController extends AbstractController
{
    #[Route('/serie', name: 'app_serie')]
    public function index(): Response
    {
        return $this->render('serie/serie.html.twig');
    }

    #[Route('/ajouter/serie', name: 'ajouter_serie')]
    public function ajouterSerie(): Response
    {
        $formulaire = $this->createForm (SerieType::class);
        $vars = ['formulaire'=> $formulaire->createView()];

        return $this->render('serie/ajouter_serie.html.twig', $vars);
    }
}
