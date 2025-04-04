<?php

namespace App\Repository;

use App\Entity\LikeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LikeEntity>
 */
class LikeEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LikeEntity::class);
    }

    /**
     * @param PostEntity $post
     * @param UserEntity $user
     * @return LikeEntity|null
     */

     public function findExistingLike(PostEntity $post, UserEntity $user): ?LikeEntity 
     {
        return $this->createQueryBuilder('l')
            ->andWhere('l.post= :post')
            ->andWhere('l.user= :user')
            ->setParameter('post', $post)
            ->setParameter('user',$user)
            ->getQuery()
            ->getOneOrNullResult();
     }
}


//    /**
//     * @return LikeEntity[] Returns an array of LikeEntity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LikeEntity
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

