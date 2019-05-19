<?php

namespace App\DataFixtures;

use App\Entity\Performance;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PerformanceFixtures extends Fixture
{
    const PICTURE_PERFORMANCE = [
        '5c515fda81e8f469946240.jpg',
        '5c51604b72b22742338363.jpg',
        '5c51668e79002171914786.jpg',
        '5c5166b31b058616044549.jpg',
        '5c516720eb61a029256783.jpg',
        '5c51673c4955e094554995.jpg'
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_EN');

        foreach (self::PICTURE_PERFORMANCE as $key => $picture) {
            $performance = new Performance();
            $performance->setName($faker->words(2, true));
            $performance->setDescription(($faker->paragraphs(2, true)));
            $performance->setPicture($picture);
            $manager->persist($performance);
            $this->addReference('performance_' . $key, $performance);
        }

        $manager->flush();
    }
}
