<?php

namespace App\Repository;

use App\Entity\DateShow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DateShow|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateShow|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateShow[]    findAll()
 * @method DateShow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateShowRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DateShow::class);
    }

    // /**
    //  * @return DateShow[] Returns an array of DateShow objects
    //  */
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
    public function findOneBySomeField($value): ?DateShow
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
