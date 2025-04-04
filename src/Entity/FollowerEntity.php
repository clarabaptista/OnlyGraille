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

    #[ORM\ManyToMany(targetEntity:'App\Entity\UserEntity', inversedBy:'following')]
    #[ORM\JoinTable(name:'followers')]
    private $followers ;

    #[ORM\ManyToMany(targetEntity:'App\Entity\UserEntity', mappedBy:'followers')]
    private $following;

    public function __construct()
    {
        $this->followers = new ArrayCollection();
        $this->following = new ArrayCollection();
    }

    /**
     * @return Collection<int, UserEntity>
     */
    public function getFollowers(): Collection
    {
        return $this->followers;
    }

    /**
     * @return Collection<int, UserEntity>
     */
    public function getFollowing(): Collection
    {
        return $this->following;
    }

}