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

    public function getPassword (): ?string
    {
        return $this->password;
    }

    public function setPassword (string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getEmail (): ?string
    {
        return $this->email;
    }

    public function setEmail (string $email) : self
    {
        $this->email = $email;
        return $this;
    }

}

 



