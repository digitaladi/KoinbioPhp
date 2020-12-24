<?php

namespace App\Repository;

use App\Entity\DeriveFiche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DeriveFiche|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeriveFiche|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeriveFiche[]    findAll()
 * @method DeriveFiche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeriveFicheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeriveFiche::class);
    }

    // /**
    //  * @return DeriveFiche[] Returns an array of DeriveFiche objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DeriveFiche
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
