<?php

// src/DataFixtures/FrameFixtures.php

namespace App\DataFixtures;

use App\Entity\UserEntity;
use App\Entity\Frame;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FrameFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new UserEntity();
        $user->setUsername('JohnDoe');
        $user->setProfilePicture('path/to/profile_picture.jpg');  // Mets à jour ce chemin avec une image valide

        $manager->persist($user);

        $frame = new Frame();
        $frame->setUserEntity($user); // Association de l'utilisateur
        $frame->setDescription('Ceci est une publication de test.');
        $frame->setLikes(10);

        $manager->persist($frame);

        // Enregistrement dans la base de données
        $manager->flush();
    }
}


?>