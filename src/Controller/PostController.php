<?php

namespace App\Controller;

use App\Entity\PostEntity;
use App\Repository\PostEntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PostController extends AbstractController{
    #[Route('/post', name: 'app_post')]
    public function index(PostEntityRepository $postRepository): Response
    {
        $posts = $postRepository->findMostRecentPosts();

        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'post' => $posts
        ]);
    }
}
