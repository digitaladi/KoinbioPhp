<?php

namespace App\Repository;

use App\Entity\ResponseCommentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ResponseCommentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResponseCommentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResponseCommentaire[]    findAll()
 * @method ResponseCommentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResponseCommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResponseCommentaire::class);
    }

    // /**
    //  * @return ResponseCommentaire[] Returns an array of ResponseCommentaire objects
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
    public function findOneBySomeField($value): ?ResponseCommentaire
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
