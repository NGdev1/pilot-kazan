<?php

namespace App\Repository;

use App\Entity\UserApplication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserApplication|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserApplication|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserApplication[]    findAll()
 * @method UserApplication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserApplicationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserApplication::class);
    }

//    /**
//     * @return UserApplication[] Returns an array of UserApplication objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserApplication
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
