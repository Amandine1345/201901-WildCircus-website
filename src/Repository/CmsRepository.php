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
}
