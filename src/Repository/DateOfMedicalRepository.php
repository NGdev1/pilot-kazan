<?php

namespace App\Repository;

use App\Entity\DateOfMedical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DateOfMedical|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateOfMedical|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateOfMedical[]    findAll()
 * @method DateOfMedical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateOfMedicalRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DateOfMedical::class);
    }

//    /**
//     * @return DateOfMedical[] Returns an array of DateOfMedical objects
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
    public function findOneBySomeField($value): ?DateOfMedical
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
