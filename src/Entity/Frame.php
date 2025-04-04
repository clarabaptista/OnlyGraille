<?php

// src/Entity/Frame.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FrameRepository;
use App\Entity\UserEntity; 

#[ORM\Entity(repositoryClass: FrameRepository::class)]
class Frame
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: 'integer')]
    private ?int $likes = 0;

    #[ORM\ManyToOne(targetEntity: UserEntity::class)]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id")]
    private ?UserEntity $userEntity = null; 

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $image = null; 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getUserEntity(): ?UserEntity
    {
        return $this->userEntity;
    }

    public function setUserEntity(UserEntity $userEntity): self
    {
        $this->userEntity = $userEntity;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): self
    {
        $this->likes = $likes;
        return $this;
    }
}


?>
