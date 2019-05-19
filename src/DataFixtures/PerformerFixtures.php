<?php

namespace App\DataFixtures;

use App\Entity\Performer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PerformerFixtures extends Fixture implements DependentFixtureInterface
{
    const PICTURE_PERFORMER = [
        ['5c4eda5bb26ea495963393.png', 'BO'],
        ['5c4eda869feb5989885921.png', 'BR'],
        ['5c4edab068932075970977.png', 'DK'],
        ['5c4edad5f0cfe908420949.png', 'HU'],
        ['5c4edafbe9188398293991.png', 'AR'],
        ['5c6985729f04c621753485.png', 'RU']
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_EN');
        $i = 0;

        foreach (self::PICTURE_PERFORMER as $picture) {
            $performer = new Performer();
            $performer->setName($faker->name());
            $performer->setBiography($faker->paragraphs(2, true));
            $performer->setBirthday(new \DateTime($faker->date('Y-m-d', 'now')));
            $performer->setPicture($picture[0]);
            $performer->setCountryIso($picture[1]);
            $performer->addPerformance($this->getReference('performance_' . $i));

            $manager->persist($performer);
            $i++;
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [PerformanceFixtures::class];
    }
}
