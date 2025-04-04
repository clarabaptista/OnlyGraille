<?php

namespace App\Controller;

use App\Repository\FrameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(FrameRepository $frameRepository, UserInterface $user): Response
    {
        $frames = $frameRepository->findBy(['user' => $user], ['id' => 'DESC']);
    
        return $this->render('frame/framefeed.html.twig', [
            'frames' => $frames,
            'user' => $user, 
        ]);
    }
}
