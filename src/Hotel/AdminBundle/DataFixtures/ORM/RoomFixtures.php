<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 22.07.15
 * Time: 14:07
 */

namespace Hotel\AdminBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Hotel\AdminBundle\Entity\Room;

class RoomFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $roomsList = array();
        for($i = 0; $i < 6; $i++) {
            for ($j = 0; $j < 9; $j++) {
                $roomsList[$i][$j] =
                    array(
                        'floorId' => $i,
                        'numberOfPeople' => ($i < 1 || $i > 3) ? 3 : $i,
                        'forSmokinPeople' => $i != 0 ? 1 : 0,
                        'roomNumber' => $i . '0' . $j,
                    );

            }
        }

        foreach ($roomsList as $parentKey => $value) {
            foreach ($value as $key => $value) {
                $Room = new Room();

                $Room
                    ->setNumberOfPeople($value['numberOfPeople'])
                    ->setForSmokingPeople('forSmokinPeople')
                    ->setRoomNumber($value['roomNumber'])
                ;

                $Room->setFloor($this->getReference('floor_'.$value['floorId']));

                $this->addReference('room_'.$value['roomNumber'], $Room);

                $manager->persist($Room);
            }
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
        return 1;
    }
}