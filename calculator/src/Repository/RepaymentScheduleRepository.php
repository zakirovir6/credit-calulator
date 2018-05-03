<?php

namespace App\Repository;

use App\Entity\RepaymentSchedule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RepaymentSchedule|null find($id, $lockMode = null, $lockVersion = null)
 * @method RepaymentSchedule|null findOneBy(array $criteria, array $orderBy = null)
 * @method RepaymentSchedule[]    findAll()
 * @method RepaymentSchedule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RepaymentScheduleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RepaymentSchedule::class);
    }

//    /**
//     * @return RepaymentSchedule[] Returns an array of RepaymentSchedule objects
//     */
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
    public function findOneBySomeField($value): ?RepaymentSchedule
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
