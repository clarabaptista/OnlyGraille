<?php

namespace App\Entity;

use App\Repository\LikeEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeEntityRepository::class)]
class LikeEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $likes = null;

    #[ORM\Column(length: 255)]
    private PostEntity $post;

    #[ORM\Column(length: 255)]
    private UserEntity $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLikes(): ?string
    {
        return $this->likes;
    }

    public function setLikes(string $likes): static
    {
        $this->likes = $likes;

        return $this;
    }

    public function getPosts(): ?string
    {
        return $this->posts;
    }

    public function setPosts(string $posts): static
    {
        $this->posts = $posts;

        return $this;
    }

    public function getUsers(): ?string
    {
        return $this->users;
    }

    public function setUsers(string $users): static
    {
        $this->users = $users;

        return $this;
    }
}
