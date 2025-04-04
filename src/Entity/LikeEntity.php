<?php

namespace App\Entity;

use App\Repository\LikeEntityRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\PostEntity;
use App\Entity\UserEntity;

#[ORM\Entity(repositoryClass: LikeEntityRepository::class)]
class LikeEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\ManyToOne(targetEntity: PostEntity::class, inversedBy: 'likes')]
    #[ORM\JoinColumn(nullable: false)] 
    private PostEntity $post;

    #[ORM\ManyToOne(targetEntity: UserEntity::class, inversedBy: 'likes')]
    #[ORM\JoinColumn(nullable: false)] 
    private UserEntity $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): PostEntity
    {
        return $this->post;
    }

    public function setPost(PostEntity $post): static
    {
        $this->post = $post;

        return $this;
    }

    public function getUser(): UserEntity
    {
        return $this->user;
    }

    public function setUser(UserEntity $user): static
    {
        $this->user = $user;

        return $this;
    }
}
