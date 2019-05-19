<?php

namespace App\DataFixtures;

use App\Entity\DateShow;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class DateShowFixtures extends Fixture
{
    const DATE_SHOW = [
        ['BORGO (2B - Haute-Corse)', '9.4560415852941', '42.573811261765'],
        ['ORLÉANS (45 - Loiret)', '1.9171840806223', '47.882848404526'],
        ['NANTES (44 - Loire-Atlantique)', '-1.5491679930394', '47.239654546404'],
        ['PARIS (75 - Paris)', '2.3752385652174', '48.844999227053'],
        ['CHAMBÉRY (73 - Savoie)', '5.911690578125', '45.579342194196'],
        ['BOU (45 - Loiret)', '2.0468831088435', '47.87152855102'],
        ['STRASBOURG (67 - Bas-Rhin)', '7.75525939807', '48.56731468275'],
        ['MARSEILLE (13 - Bouches-du-Rhône)', '5.3722425218771', '43.254529956413']
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach (self::DATE_SHOW as $show) {
            $dateShow = new DateShow();
            $dateShow->setDate($faker->dateTimeBetween('now', '+2 years'));
            $dateShow->setCity($show[0]);
            $dateShow->setLongitude($show[1]);
            $dateShow->setLatitude($show[2]);
            $manager->persist($dateShow);
            $manager->flush();
        }
    }
}
