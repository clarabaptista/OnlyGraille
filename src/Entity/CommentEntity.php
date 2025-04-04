<?php

namespace App\Entity;

use App\Repository\CommentEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentEntityRepository::class)]
class CommentEntity 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type : 'text')]
    private ?string $content = null;

    #[ORM\ManyToOne(targetEntity: PostEntity::class, inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PostEntity $post = null;

    #[ORM\ManytoOne(targetEntity: UserEntity::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?UserEntity $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;
        return $this;
    }

    public function getPost(): ?PostEntity
    {
        return $this->post;
    }

    public function setPost(string $post): static
    {
        $this->post = $post;
        return $this;
    }

    public function getUser(): ?UserEntity
    {
        return $this->user;
    }

    public function setUser(string $user): static
    {
        $this->user = $user;
        return $this;
    }
}
    






