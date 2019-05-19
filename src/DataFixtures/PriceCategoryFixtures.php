<?php

namespace App\DataFixtures;

use App\Entity\PriceCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PriceCategoryFixtures extends Fixture
{
    const PRICE_CATEGORIES = [
        'Adults > 12 years old',
        'Children 3-11 years old',
        'Seniors > 60 years old'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PRICE_CATEGORIES as $key => $category) {
            $priceCategory = new PriceCategory();
            $priceCategory->setName($category);
            $manager->persist($priceCategory);
            $this->addReference('category_' . $key, $priceCategory);
        }
        $manager->flush();
    }
}
