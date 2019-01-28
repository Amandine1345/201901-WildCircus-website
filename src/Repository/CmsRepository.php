<?php

namespace App\Repository;

use App\Entity\Cms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cms|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cms|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cms[]    findAll()
 * @method Cms[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CmsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cms::class);
    }

    // /**
    //  * @return Cms[] Returns an array of Cms objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cms
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
