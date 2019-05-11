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

    /**
     * @param int $limit
     * @return Array|null
     */
    public function findByDate(int $limit = null): ?Array
    {
        $query = $this->createQueryBuilder('d')
            ->where('d.date >= CURRENT_DATE()')
            ->orderBy('d.date', 'ASC');

        if (!is_null($limit)) {
            $query->setMaxResults($limit);
        }

        $query = $query->getQuery()->getArrayResult();

        return $query;
    }
}
