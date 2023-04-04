<?php

namespace App\Controller;

use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    #[Route('/list', name: 'app_list')]
    public function index( SessionInterface $session, SerieRepository $serieRepository): Response
    {
        $liste = $session->get('liste', []);

        $listeData = [];


        foreach($liste as $id => $cmbSerieInList){
            $listeData[] = [
                'serie' => $serieRepository->find($id),
                'cmbSerieInListe' => $cmbSerieInList
            ];

        }


        return $this->render('list/list.html.twig', [
            'items' => $listeData
        ]);
    }

    #[Route('/list/add/{id}', name: 'list_add')]
    public function add($id, SessionInterface $session){



        //pour ajouter plusieur fois la meme serie dans la liste

        // if(!empty($liste[$id])) {
        //     $liste[$id]++;
        // } else {
        //     $liste[$id] = 1;
        // }


        dd($session->get('liste'));
    }
}
