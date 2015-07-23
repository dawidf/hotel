<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 22.07.15
 * Time: 14:04
 */

namespace Hotel\AdminBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Hotel\AdminBundle\Entity\Floor;

class FloorFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $Floors = array(
            '0' => '0',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5'

        );

        foreach ($Floors as $key => $value) {
            $Floor = new Floor();
            $Floor->setFloor($value);

            $manager->persist($Floor);
            $this->addReference('floor_'.$key, $Floor);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 0;
    }
}