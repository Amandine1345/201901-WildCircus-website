<?php

namespace App\Repository;

use App\Entity\Performance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Performance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Performance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Performance[]    findAll()
 * @method Performance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformanceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Performance::class);
    }
}
