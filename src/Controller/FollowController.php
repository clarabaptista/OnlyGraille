 <?php

// namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Routing\Annotation\Route;
// use Doctrine\ORM\EntityManagerInterface;
// use App\Service\UserPasswordHashing;
// use App\Form\RegistrationFormType;
// use App\Entity\User;

// final class UserController extends AbstractController {
    
//     #[Route('/user', name: 'app_user')]
//     public function index(): Response {
//         return $this->render('user/index.html.twig', [
//             'controller_name' => 'UserController',
//         ]);
//     }

//     // Follow
//     #[Route('/user/{id}/follow', name: 'user_follow', methods: [POST])]
//     public function follow(User $user, EntityManagerInterface $em): Response
//     {
//         $userConnecté = $this->getUser();
//         if (!$userConnecté) {
//             return $this->json(['error' => 'Vous devez être connecté'], 401);
//         }
//         if ($user !== $userConnecté) {
//             $user->addFollower($userConnecté);
//             $em->flush();
//             return $this->json(['message' => 'Utilisateurs suiuvi !'], 400);
//         }
//     }

//     // Unfollow
//     #[Route('/user/{id}/unfollow', name: 'user_follow', methods: [POST])]
//     public function unfollow(User $user, EntityManagerInterface $em): Response
//     {
//         $userConnecté = $this->getUser();
//         if (!$userConnecté) {
//             return $this->json(['error' => 'Vous devez être connecté'], 401);
//         }
//         if ($user->getFollower()->contains($userConnecté)) {
//             $user->removeFollower($userConnecté);
//             $em->flush();
//             return $this->json(['message' => 'Vous ne suiuvez plus cet utilisateur'], 400);
//         }
 
//     }
// } -->