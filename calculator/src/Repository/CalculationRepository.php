<?php

namespace App\Repository;

use App\Entity\Calculation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Calculation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calculation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calculation[]    findAll()
 * @method Calculation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalculationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Calculation::class);
    }

//    /**
//     * @return Calculation[] Returns an array of Calculation objects
//     */
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
    public function findOneBySomeField($value): ?Calculation
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
