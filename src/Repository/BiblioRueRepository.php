<?php

namespace App\Repository;

use App\Entity\BiblioRue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BiblioRue|null find($id, $lockMode = null, $lockVersion = null)
 * @method BiblioRue|null findOneBy(array $criteria, array $orderBy = null)
 * @method BiblioRue[]    findAll()
 * @method BiblioRue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiblioRueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BiblioRue::class);
    }

    // /**
    //  * @return BiblioRue[] Returns an array of BiblioRue objects
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
    public function findOneBySomeField($value): ?BiblioRue
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
