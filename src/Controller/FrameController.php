<?php

namespace App\Controller;

use App\Entity\Frame;
use App\Repository\FrameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrameController extends AbstractController
{
    #[Route('/connect', name: 'feed')]
    public function index(FrameRepository $frameRepository): Response
    {
        $frames = $frameRepository->findBy([], ['id' => 'DESC']);

        return $this->render('frame/framefeed.html.twig', [
            'frames' => $frames,
        ]);
    }

    #[Route('/frame/{id}/like', name: 'frame_like')]
    public function like(Frame $frame, EntityManagerInterface $em): Response
    {
        // Ajouter un like à la publication
        $frame->setLikes($frame->getLikes() + 1);
        
        $em->flush();

        // Rediriger vers la page d'accueil du feed
        return $this->redirectToRoute('feed');
    }
}
