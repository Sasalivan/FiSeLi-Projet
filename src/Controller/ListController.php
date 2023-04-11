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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
    public function add($id, ManagerRegistry $doctrine){

        $em = $doctrine->getManager();

        
        $serie = $em->getRepository(Serie::class)->find($id); 
        $user = $this->getUser();

        $status = new StatusSerie();
        $status->setNomStatus('A voir');
        $status->setUser($user);
        $status->setSerie($serie);

        $em->persist($status);
        $em->flush();

        return $this->redirectToRoute('app_list');
    }

    #[Route('/list/update/{id}', name: 'list_update')]
    public function update($id, Request $request, ManagerRegistry $doctrine)
    {
        $em = $doctrine->getManager();
        $status = $em->getRepository(StatusSerie::class)->find($id);
    
        if (!$status) {
            throw $this->createNotFoundException('Status not found');
        }
    
        $form = $this->createFormBuilder($status)
            ->add('nomStatus', ChoiceType::class, [
                'choices' => [
                    'En cours' => 'En cours',
                    'Terminée' => 'Terminée',
                    'A voir' => 'A voir'
                ],
                'expanded' => true,
                'multiple' => false,
                'label' => 'Status'
            ])
            ->add('nbEpisodeUser', IntegerType::class, [
                'label' => 'Episode en cours'
            ])
            
            ->getForm();
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            if ($status->getNbEpisodeUser() > $status->getSerie()->getEpisode()) {
                $this->addFlash('error', 'Le nombre d\'épisodes ne doit pas dépasser celui de la série');
                return $this->redirectToRoute('list_update', ['id' => $id]);
            }
            $em->flush();
    
            return $this->redirectToRoute('app_list');
        }
    
        return $this->render('list/update.html.twig', [
            'form' => $form->createView(),
            'status' => $status
        ]);
    }
}
