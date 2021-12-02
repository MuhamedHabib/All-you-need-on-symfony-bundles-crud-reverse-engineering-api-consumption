<?php

namespace App\Repository;

use App\Entity\Questionss;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Questionss|null find($id, $lockMode = null, $lockVersion = null)
 * @method Questionss|null findOneBy(array $criteria, array $orderBy = null)
 * @method Questionss[]    findAll()
 * @method Questionss[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionssRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Questionss::class);
    }

    // /**
    //  * @return Questionss[] Returns an array of Questionss objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Questionss
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
