<?php

namespace App\DataFixtures;

use App\Entity\Price;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PriceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                $price = new Price();
                $price->setPeriod($this->getReference('period_' . $i));
                $price->setPrice(rand(45, 250));
                $price->setCategory($this->getReference('category_' . $j));
                $manager->persist($price);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [PriceCategoryFixtures::class, PricePeriodFixtures::class];
    }
}
