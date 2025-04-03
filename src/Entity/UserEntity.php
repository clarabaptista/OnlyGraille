<?php

namespace App\Entity;

use App\Repository\UserEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserEntityRepository::class)]
class UserEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
    private ?string $username = null;

    #[ORM\Column(type:'string')]
    private ?string $password = null;

    #[ORM\Column(type:'string', length: 255, nullable: true)]
    private ?email $email = null;

    #[ORM\ManyToMany(targetEntity:'App\Entity\UserEntity', inversedBy:'following')]
    #[ORM\JoinTable(name:'followers')]
    private $followers ;

    #[ORM\ManyToMany(targetEntity:'App\Entity\UserEntity', mappedBy:'followers')]
    private $following;

    
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }
}
