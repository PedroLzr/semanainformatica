<?php

namespace App\Repository;

use App\Entity\Categoriataller;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Categoriataller|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categoriataller|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categoriataller[]    findAll()
 * @method Categoriataller[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriatallerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoriataller::class);
    }

    // /**
    //  * @return Categoriataller[] Returns an array of Categoriataller objects
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
    public function findOneBySomeField($value): ?Categoriataller
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
