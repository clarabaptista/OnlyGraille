<?php

namespace App\Controller;

use App\Entity\CommentEntity;
use App\Entity\PostEntity;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    // Créer Commentaire
    #[Route('/post/post{id}/comment', name: 'comment_create', methods: ['POST'])]
    public function createComment(int $postId, Request $request, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(PostEntity::class)->find($postId);
        if (!$post) {
            return $this->json(['error' => 'Post introuvable'], 404);
        }

        $user = $this->getUser();
        if (!$user) {
            return $this->json(['error' => 'Connectez-vous pour commenter'], 401);
        }

        $content = $request->request->get('content');
        if (!$content) {
            return $this->json(['error' => 'Un commentaire ne peut pas être vide'], 400);
        }

        $comment = new CommentEntity();
        $comment->setContent($content);
        $comment->setPost($post);
        $comment->setUser($user);

        $em->persist($comment);
        $em->flush();

        return $this->json(['message' => 'Commentaire ajouté avec succès'], 200);
    }

    // Afficher les commentaire d'un post
    #[Route('/post/{postId}/comments', name: 'comments_list', methods: ['GET'])]
    public function listComments(int $postId, EntityManagerInterface $em): Response
    {
        $post = $em->getRepository(PostEntity::class)->find($postId);
        if (!$post) {
            return $this->json(['error' => 'Post introuvable'], 404);
        }

        $comments = $em->getRepository(CommentEntity::class)->findCommentsByPost($postId);

        return $this->json($comments, 200);
    }
}