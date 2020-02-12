<?php

namespace App\Repository;

use App\Entity\Categoriaponencia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Categoriaponencia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categoriaponencia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categoriaponencia[]    findAll()
 * @method Categoriaponencia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriaponenciaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoriaponencia::class);
    }

    // /**
    //  * @return Categoriaponencia[] Returns an array of Categoriaponencia objects
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
    public function findOneBySomeField($value): ?Categoriaponencia
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
