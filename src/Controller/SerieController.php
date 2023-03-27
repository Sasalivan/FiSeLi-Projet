<?php

namespace App\Controller;

use App\Entity\Serie;

use App\Form\SerieType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SerieController extends AbstractController
{
    #[Route('/serie', name: 'app_serie')]
    public function index(): Response
    {
        return $this->render('serie/serie.html.twig');
    }



    #[Route('/ajouter/serie', name: 'ajouter_serie')]
    public function ajouterSerie(Request $req, ManagerRegistry $doctrine): Response
    {
        
        $serie = new Serie();

        $formulaire = $this->createForm (SerieType::class, $serie);

        $formulaire->handleRequest($req);

        if ($formulaire-> isSubmitted()){
            //prendre donnée et ajouter dans la db 
            $em = $doctrine->getManager();
            $em->persist($serie);
            $em->flush();
            //et rediriger vers la page de la fiche de la série
            return new Response("Série enregistrer dna sla db");
           
        }
        else {
            $vars = ['formulaire'=> $formulaire->createView()];
    
            return $this->render('serie/ajouter_serie.html.twig', $vars);
        }


    }
}
