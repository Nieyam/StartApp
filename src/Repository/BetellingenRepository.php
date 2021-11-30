<?php

namespace App\Repository;

use App\Entity\Betellingen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Betellingen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Betellingen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Betellingen[]    findAll()
 * @method Betellingen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BetellingenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Betellingen::class);
    }

    // /**
    //  * @return Betellingen[] Returns an array of Betellingen objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Betellingen
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
