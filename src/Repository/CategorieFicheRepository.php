<?php

namespace App\Repository;

use App\Entity\CategorieFiche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategorieFiche|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieFiche|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieFiche[]    findAll()
 * @method CategorieFiche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieFicheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieFiche::class);
    }

    // /**
    //  * @return CategorieFiche[] Returns an array of CategorieFiche objects
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
    public function findOneBySomeField($value): ?CategorieFiche
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
