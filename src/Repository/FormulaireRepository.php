<?php

namespace App\Repository;

use App\Entity\Formulaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Formulaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formulaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formulaire[]    findAll()
 * @method Formulaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormulaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formulaire::class);
    }

    /**
     *  @return Formulaire[] Returns an array of Formulaire objects
     */

    public function filter($Sex)
    {
        return $this->createQueryBuilder('sortie')
            ->andWhere('sortie.Sexe = :Sexe')
            ->setParameter('Sexe', $Sex)
            ->getQuery()
            ->getResult()
            ;

    }
    // /**
    //  * @return Formulaire[] Returns an array of Formulaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Formulaire
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
