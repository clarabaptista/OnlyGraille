<?php

namespace App\Controller;

use App\Entity\LikeEntity;
use App\Entity\PostEntity;
use App\Entity\UserEntity;
use App\Repository\LikeEntityRepository;
use App\Repository\PostEntityRepository;
use App\Repository\UserEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class LikeController extends AbstractController{
    // #[Route('/like', name: 'app_like')]
    // public function index(): Response
    // {
    //     return $this->render('like/index.html.twig', [
    //         'controller_name' => 'LikeController',
    //     ]);
    // }

    // Like un post
    #[Route('/post/{postId}/like', name: 'like_post', methods: ['POST'])]
    public function likePost(int $postId, EntityManagerInterface $em, Request $request): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['error' => 'Connectez-vous pour pouvoir liker'], 401);
        }

        $post = $em->getRepository(PostEntity::class)->find($postId);
        if (!$post) {
            return $this->json(['error' => 'Post introuvable'], 404);
        }

        $likeRepository = $em->getRepository(LikeEntity::class);
        $existingLike = $likeRepository->findExistingLike($post, $user);

        if ($existingLike) {
            return $this->json(['error' => 'Vous avez déjà liké ce post'], 400);
        }

        $like = new LikeEntity();
        $like = setPost($post);
        $like = setUser($user);

        $em->persist($like);
        $em->flush();

        return $this->json(['message' => 'Post liké !'], 200);
    }
}
