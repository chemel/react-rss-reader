<?php

namespace App\Repository;

use App\Entity\FeedCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FeedCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method FeedCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method FeedCategory[]    findAll()
 * @method FeedCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FeedCategory::class);
    }

    // /**
    //  * @return FeedCategory[] Returns an array of FeedCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FeedCategory
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
