<?php

namespace App\Repository;

use App\Entity\AdvertRespnse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method AdvertRespnse|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdvertRespnse|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdvertRespnse[]    findAll()
 * @method AdvertRespnse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertRespnseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdvertRespnse::class);
    }

    // /**
    //  * @return AdvertRespnse[] Returns an array of AdvertRespnse objects
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
    public function findOneBySomeField($value): ?AdvertRespnse
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
