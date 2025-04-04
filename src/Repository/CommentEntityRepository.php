<?php

namespace App\Repository;

use App\Entity\CommentEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CommentEntity>
 */

 class CommentEntityRepository extends ServiceEntityRepository
 {
     public function __construct(ManagerRegistry $registry)
     {
         parent::__construct($registry, CommentEntity::class);
     }

     public function findCommentByPost(int $postId)
     {
        return $this->createQueryBuilder('c')
        ->andWhere('c.post= :postId')
        ->setParameter('postId', $postId)
        ->orderBY('c.id', 'ASC')
        ->getQuery()
        ->getOneOrNullResult();
     }
}