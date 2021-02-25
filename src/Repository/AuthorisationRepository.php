<?php

namespace App\Repository;

use App\Entity\Authorisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Authorisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Authorisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Authorisation[]    findAll()
 * @method Authorisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Authorisation::class);
    }

    // /**
    //  * @return Authorisation[] Returns an array of Authorisation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Authorisation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
