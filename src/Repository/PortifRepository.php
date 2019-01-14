<?php

namespace App\Repository;

use App\Entity\Portif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Portif|null find($id, $lockMode = null, $lockVersion = null)
 * @method Portif|null findOneBy(array $criteria, array $orderBy = null)
 * @method Portif[]    findAll()
 * @method Portif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortifRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Portif::class);
    }

    // /**
    //  * @return Portif[] Returns an array of Portif objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Portif
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
