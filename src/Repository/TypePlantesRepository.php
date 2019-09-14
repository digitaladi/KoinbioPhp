<?php

namespace App\Repository;

use App\Entity\TypePlantes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypePlantes|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePlantes|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePlantes[]    findAll()
 * @method TypePlantes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePlantesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypePlantes::class);
    }

    // /**
    //  * @return TypePlantes[] Returns an array of TypePlantes objects
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
    public function findOneBySomeField($value): ?TypePlantes
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
