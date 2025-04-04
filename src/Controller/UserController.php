<?php

namespace App\Controller;

use App\Entity\UserEntity;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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
        $inscription->handleRequest($request);
       
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

    // Deconnexion 
    #[Route('/logout', name: 'app_logout', methods:['GET'])]
    public function logout(): void
    {

    }
   
    // Affichage profil utilisateur
    #[Route('/user{id}', name: 'user_profile', methods: ['GET'])]
    public function userProfileCheck(UserEntity $user): Response {
        return $this->render('user/profile.html.twig', [
            'user' => $user,
        ]);
    }
}

