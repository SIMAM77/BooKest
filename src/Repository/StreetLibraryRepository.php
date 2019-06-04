<?php

namespace App\Repository;

use App\Entity\StreetLibrary;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StreetLibrary|null find($id, $lockMode = null, $lockVersion = null)
 * @method StreetLibrary|null findOneBy(array $criteria, array $orderBy = null)
 * @method StreetLibrary[]    findAll()
 * @method StreetLibrary[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StreetLibraryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StreetLibrary::class);
    }

    // /**
    //  * @return StreetLibrary[] Returns an array of StreetLibrary objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StreetLibrary
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
