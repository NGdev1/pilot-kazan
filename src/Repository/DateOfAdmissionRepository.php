<?php

namespace App\Repository;

use App\Entity\DateOfAdmission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DateOfAdmission|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateOfAdmission|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateOfAdmission[]    findAll()
 * @method DateOfAdmission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateOfAdmissionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DateOfAdmission::class);
    }

//    /**
//     * @return DateOfAdmission[] Returns an array of DateOfAdmission objects
//     */
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
    public function findOneBySomeField($value): ?DateOfAdmission
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
