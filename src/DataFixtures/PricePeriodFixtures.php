<?php

namespace App\DataFixtures;

use App\Entity\PricePeriod;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PricePeriodFixtures extends Fixture
{
    const PRICE_PERIODS = [
        'Full price',
        'Christmas',
        'Premium'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PRICE_PERIODS as $key => $period) {
            $pricePeriod = new PricePeriod();
            $pricePeriod->setName($period);
            $manager->persist($pricePeriod);
            $this->addReference('period_' . $key, $pricePeriod);
        }
        $manager->flush();
    }
}
