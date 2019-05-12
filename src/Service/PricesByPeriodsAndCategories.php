<?php

namespace App\Service;

use App\Entity\Price;
use Doctrine\ORM\EntityManagerInterface;

class PricesByPeriodsAndCategories
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * PricesByPeriodsAndCategories constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param array $pricePeriods
     * @param array $priceCategories
     * @return array
     */
    public function getTable(array $pricePeriods, array $priceCategories): array
    {
        $pricesTable = [];
        for ($i = 0; $i < count($pricePeriods); $i++) {
            $pricesTable[$i] = [
                'period' => $pricePeriods[$i],
                'details' => []
            ];
            foreach ($priceCategories as $category) {
                $price = $this->getEm()->getRepository(Price::class)->findOneBy([
                    'period' => $pricePeriods[$i]->getId(),
                    'category' => $category->getId()
                ], []);
                array_push($pricesTable[$i]['details'], [
                    'category' => $category->getId(),
                    'price' => $price
                ]);
            }
        }

        return $pricesTable;
    }

    /**
     * @return EntityManagerInterface
     */
    public function getEm(): EntityManagerInterface
    {
        return $this->em;
    }
}
