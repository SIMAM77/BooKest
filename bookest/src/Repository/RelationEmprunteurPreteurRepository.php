<?php

namespace App\Repository;

use App\Entity\RelationEmprunteurPreteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RelationEmprunteurPreteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelationEmprunteurPreteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelationEmprunteurPreteur[]    findAll()
 * @method RelationEmprunteurPreteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelationEmprunteurPreteurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RelationEmprunteurPreteur::class);
    }

    // /**
    //  * @return RelationEmprunteurPreteur[] Returns an array of RelationEmprunteurPreteur objects
    //  */
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
    public function findOneBySomeField($value): ?RelationEmprunteurPreteur
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
