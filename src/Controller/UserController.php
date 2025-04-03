<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\UserPasswordHashing;
use App\Form\RegistrationFormType;
use App\Entity\User;

final class UserController extends AbstractController {
    
    #[Route('/user', name: 'app_user')]
    public function index(): Response {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    // Inscription
    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function register(Request $request, UserPasswordHashing $passwordHashing, EntityManagerInterface $em): Response {
        $user = new User();
        $inscription = $this->createForm(RegistrationFormType::class, $user);
        $inscription->handleRequest($request);  // Correction ici
       
        if ($inscription->isSubmitted() && $inscription->isValid()) { 
            $hashedPassword = $passwordHashing->hashPassword($user, $inscription->get('motDePasse')->getData());
            $user->setPassword($hashedPassword);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/register.html.twig', [
            'inscription' => $inscription->createView(),
        ]);
    }
    
    // Connexion
    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(Authentification $authentification): Response {
        $error = $authentification->getLastAuthentificationError();
        $lastUsername = $authentification->getLastUsername();
        return $this->render('user/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    // Follow
    #[Route('/user/{id}/follow', name: 'user_follow', methods: [POST])]
    public function follow(User $user, EntityManagerInterface $em): Response
    {
        $userConnecté = $this->getUser();
        if (!$userConnecté) {
            return $this->json(['error' => 'Vous devez être connecté'], 401);
        }
        if ($user !== $userConnecté) {
            $user->addFollower($userConnecté);
            $em->flush();
            return $this->json(['message' => 'Utilisateurs suiuvi !'], 400);
        }
    }

    // Unfollow
    #[Route('/user/{id}/unfollow', name: 'user_follow', methods: [POST])]
    public function unfollow(User $user, EntityManagerInterface $em): Response
    {
        $userConnecté = $this->getUser();
        if (!$userConnecté) {
            return $this->json(['error' => 'Vous devez être connecté'], 401);
        }
        if ($user->getFollower()->contains($userConnecté)) {
            $user->removeFollower($userConnecté);
            $em->flush();
            return $this->json(['message' => 'Vous ne suiuvez plus cet utilisateur'], 400);
        }
    }
}

