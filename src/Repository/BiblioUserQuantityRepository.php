<?php

namespace App\Repository;

use App\Entity\BiblioUserQuantity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BiblioUserQuantity|null find($id, $lockMode = null, $lockVersion = null)
 * @method BiblioUserQuantity|null findOneBy(array $criteria, array $orderBy = null)
 * @method BiblioUserQuantity[]    findAll()
 * @method BiblioUserQuantity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiblioUserQuantityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BiblioUserQuantity::class);
    }

    // /**
    //  * @return BiblioUserQuantity[] Returns an array of BiblioUserQuantity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BiblioUserQuantity
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
