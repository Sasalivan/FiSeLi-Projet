<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Entity\StatusSerie;
use App\Repository\SerieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListController extends AbstractController
{
    #[Route('/list', name: 'app_list')]
    public function index( SessionInterface $session, SerieRepository $serieRepository): Response
    {
        
        $user = $this->getUser();

        $statuses = $user->getStatuses();
        

        return $this->render('list/list.html.twig', [
            'statuses' => $statuses
        ]);
    }

    #[Route('/list/add/{id}', name: 'list_add')]
    public function add($id, SessionInterface $session, ManagerRegistry $doctrine){

        $em = $doctrine->getManager();

        
        $serie = $em->getRepository(Serie::class)->find($id); 
        $user = $this->getUser();

        $status = new StatusSerie();
        $status->setNomStatus('planWatch');
        $status->setUser($user);
        $status->setSerie($serie);

        $em->persist($status);
        $em->flush();

        return $this->redirectToRoute('app_list');
    }
}
