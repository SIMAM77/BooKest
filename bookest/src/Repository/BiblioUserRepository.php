<?php

namespace App\Repository;

use App\Entity\BiblioUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BiblioUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method BiblioUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method BiblioUser[]    findAll()
 * @method BiblioUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiblioUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BiblioUser::class);
    }

    // /**
    //  * @return BiblioUser[] Returns an array of BiblioUser objects
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
    public function findOneBySomeField($value): ?BiblioUser
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
