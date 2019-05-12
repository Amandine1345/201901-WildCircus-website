<?php

namespace App\Repository;

use App\Entity\PricePeriod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PricePeriod|null find($id, $lockMode = null, $lockVersion = null)
 * @method PricePeriod|null findOneBy(array $criteria, array $orderBy = null)
 * @method PricePeriod[]    findAll()
 * @method PricePeriod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PricePeriodRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PricePeriod::class);
    }
}
