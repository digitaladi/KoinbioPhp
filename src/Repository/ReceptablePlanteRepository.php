<?php

namespace App\Repository;

use App\Entity\ReceptablePlante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ReceptablePlante|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReceptablePlante|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReceptablePlante[]    findAll()
 * @method ReceptablePlante[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReceptablePlanteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReceptablePlante::class);
    }

    // /**
    //  * @return ReceptablePlante[] Returns an array of ReceptablePlante objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReceptablePlante
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}