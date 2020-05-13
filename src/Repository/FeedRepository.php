<?php

namespace App\Repository;

use App\Entity\Feed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Feed|null find($id, $lockMode = null, $lockVersion = null)
 * @method Feed|null findOneBy(array $criteria, array $orderBy = null)
 * @method Feed[]    findAll()
 * @method Feed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FeedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Feed::class);
    }

    /**
     * Check if feed exist by his url
     *  
     * @param string $url
     * @return bool
     */
    public function existByUrl(string $url): bool
    {
        return $this->createQueryBuilder('f')
            ->select('COUNT(f.id)')
            ->where('f.url = :url')
            ->setParameter('url', $url)
            ->getQuery()
            ->getSingleScalarResult() > 0;
    }
}
