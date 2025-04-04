<?php

namespace App\Repository;

use App\Entity\PostEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PostEntity>
 */
class PostEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PostEntity::class);
    }

   /**
    * @return PostEntity[] Returns an array of PostEntity objects
    */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PostEntity
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

   public function findMostRecentPosts(): array
   {
        return $this->createQueryBuilder(alias: 'p')
            ->addOrderBy('p.date','DESC') // les postes du plus récent au moins récent
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
            ;
   }

   public function findMostLikedPosts(): array
   {
        return $this->createQueryBuilder(alias: 'p')
            ->addOrderBy(sort: 'p.likes', order: 'DESC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
            ;
   }

   public function findPostByUserId($user): ?PostEntity // ou array ?
   {
        return $this->createQueryBuilder(alias: 'p')
            ->andWhere('p.user = :user')
            ->setParameter('user', $user)
            ->addOrderBy('p.date','DESC')
            ->getQuery()
            ->getOneOrNullResult()
            ;
   }

   
    // public function findFavoritePosts($post): ?PostEntity
    // {
    //     return $this->createQueryBuilder(alias:'')
    // }
} 