<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $email = (new Email())
                ->from($contact->getEmail())
                ->to('ton-email@domaine.com')
                ->subject('Nouvelle inscription')
                ->text('Un nouvel utilisateur s\'est inscrit avec le mot de passe : ' . $contact->getPassword());

            $mailer->send($email);

            $this->addFlash('success', 'Inscription réussie !');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('feed/inscription.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
