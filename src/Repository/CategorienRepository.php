<?php

namespace App\Repository;

use App\Entity\Categorien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Categorien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categorien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categorien[]    findAll()
 * @method Categorien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categorien::class);
    }

    // /**
    //  * @return Categorien[] Returns an array of Categorien objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Categorien
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
