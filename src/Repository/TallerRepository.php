<?php

namespace App\Repository;

use App\Entity\Taller;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Taller|null find($id, $lockMode = null, $lockVersion = null)
 * @method Taller|null findOneBy(array $criteria, array $orderBy = null)
 * @method Taller[]    findAll()
 * @method Taller[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TallerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Taller::class);
    }

    public function buscarTalleresPorCategoria($id):array{
        $talleres = null;
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT t FROM App\Entity\Taller t WHERE t.categoriataller_id = :id');
        $query->setParameter('id', $id);
        return $query->getResult();
    }
    // /**
    //  * @return Taller[] Returns an array of Taller objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Taller
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
