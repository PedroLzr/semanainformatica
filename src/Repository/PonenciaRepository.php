<?php

namespace App\Repository;

use App\Entity\Ponencia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ponencia|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ponencia|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ponencia[]    findAll()
 * @method Ponencia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PonenciaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ponencia::class);
    }

    public function buscarPonenciasPorCategoria($id):array{
        $ponencias = null;
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT p FROM App\Entity\Ponencia p WHERE p.categoriaponencia_id = :id');
        $query->setParameter('id', $id);
        return $query->getResult();
    }

    // /**
    //  * @return Ponencia[] Returns an array of Ponencia objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ponencia
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
