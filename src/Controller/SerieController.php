<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use App\Repository\TypeSerieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SerieController extends AbstractController
{
    #[Route('/serie', name: 'app_serie')]
    public function index(SerieRepository $repo): Response
    {

        $all = $repo->findAll();
        $vars = ['all_serie' => $all];
        return $this->render('serie/serie.html.twig', $vars );
    }


    #[Route('/serie/{id}', name: 'detail')]
    public function detailSerie(Serie $series, SerieRepository $repo): Response
    {
        // dd($series);
        return $this->render('serie/detail.html.twig',[
            'series' => $series,
        ]);
    }



    #[Route('/ajouter/serie', name: 'ajouter_serie')]
    public function ajouterSerie(Request $req, ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();
        
        $serie = new Serie();

        $formulaire = $this->createForm (SerieType::class, $serie);

        $formulaire->handleRequest($req);

        if ($formulaire-> isSubmitted() && $formulaire->isValid()){

            // $imageFile = $formulaire->get('image')->getData();
            // if ($imageFile) {
            //     $newFilename = uniqid().'.'.$imageFile->guessExtension();
                
            //     $imageFile->move(
            //         $this->getParameter('images_directory'),
            //         $newFilename
            //     );
            //     $serie->setImage($newFilename);
            // }

            //prendre donnée et ajouter dans la db 
            $em = $doctrine->getManager();
            $em->persist($serie);
            $em->flush();
            //et rediriger vers la page de la fiche de la série
            // return new Response("Série enregistrer");
            return $this->redirectToRoute('detail', ['id' => $serie->getId()]);;
      
        }
        else {
            $vars = ['formulaire'=> $formulaire->createView()];
    
            return $this->render('serie/ajouter_serie.html.twig', $vars);
        }

        
    }

    #[Route ("/serie/{id}/edit", name:'edit_serie')]
    public function updateSerie(Serie $series, ManagerRegistry $doctrine, Request $req)
    {
        $em = $doctrine->getManager();

        $formulaire = $this->createForm(SerieType::class, $series);

        $formulaire->handleRequest($req);
    
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
    
            $em->flush();

            return $this->redirectToRoute('detail', ['id' => $series->getId()]);
        }

    
        return $this->render('serie/edit_serie.html.twig', [
            'serie' => $series,
            'formulaire' => $formulaire->createView(),
        ]);
    }

}
