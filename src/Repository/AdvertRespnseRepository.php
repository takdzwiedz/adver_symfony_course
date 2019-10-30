<?php

namespace App\Repository;

use App\Entity\AdvertResponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AdvertResponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdvertResponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdvertResponse[]    findAll()
 * @method AdvertResponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertRespnseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdvertResponse::class);
    }

    // /**
    //  * @return AdvertResponse[] Returns an array of AdvertResponse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdvertResponse
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
