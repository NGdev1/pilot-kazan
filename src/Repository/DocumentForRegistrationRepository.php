<?php

namespace App\Repository;

use App\Entity\DocumentForRegistration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DocumentForRegistration|null find($id, $lockMode = null, $lockVersion = null)
 * @method DocumentForRegistration|null findOneBy(array $criteria, array $orderBy = null)
 * @method DocumentForRegistration[]    findAll()
 * @method DocumentForRegistration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DocumentForRegistrationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DocumentForRegistration::class);
    }

//    /**
//     * @return DocumentForRegistration[] Returns an array of DocumentForRegistration objects
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
    public function findOneBySomeField($value): ?DocumentForRegistration
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
