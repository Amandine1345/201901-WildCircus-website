<?php

namespace App\DataFixtures;

use App\Entity\Cms;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CmsFixtures extends Fixture
{
    const CMS_TYPE = [
        0 => ['About Us', 0, '5c508411ca192637051169.jpg', '5c49d6a01be15403479428.jpg'],
        1 => ['Performers', 1, '5c5084295a203646339547.jpg'],
        2 => ['Performances', 2, '5c50847d3e2f0280328936.jpg'],
        3 => ['Dates & Prices', 3, '5cd6bded7bbc4559953674.jpg']
    ];

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        foreach (self::CMS_TYPE as $type) {
            $cms = new Cms();
            $cms->setTitle($type[0]);
            $cms->setShortDescription($faker->text(255));
            $cms->setImageBanner($type[2]);
            $cms->setCmsType($type[1]);

            // CMS About Us
            if ($type[1] === 0) {
                $cms->setImageHome($type[3]);
                $fullDescription = '<p>' . $faker->paragraphs(4, true) . '</p>';
                $fullDescription .= '<p>'
                    . '<img class="img-fluid img-thumbnail" '
                    . 'src="https://media.giphy.com/media/l0Exw6GpyKeJGRec8/giphy.gif" alt=""></p>';
                $fullDescription .= '<p>' . $faker->paragraphs(3, true) . '</p>';
                $cms->setFullDescription($fullDescription);
            }

            $manager->persist($cms);
            $manager->flush();
        }


        $manager->flush();
    }
}
