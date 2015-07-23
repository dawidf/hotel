<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 22.07.15
 * Time: 14:56
 */

namespace Hotel\AdminBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Hotel\AdminBundle\Entity\Reservation;
use Symfony\Component\Validator\Constraints\DateTime;

class ReservationFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $reservations = array(
            array(
                'roomNumber' => 101,
                'reservedDate' => '2015-07-15',
                'services' => array('sniadanie'),
                'startReservation' => '2015-07-23',
                'endReservation' => '2015-07-27',
                'email' => 'admin4@admin.pl'
            ),
            array(
                'roomNumber' => 102,
                'reservedDate' => '2015-07-15',
                'services' => array('sniadanie'),
                'startReservation' => '2015-07-16',
                'endReservation' => '2015-07-23',
                'email' => 'admin2@admin.pl'
            ),array(
                'roomNumber' => 103,
                'reservedDate' => '2015-07-15',
                'services' => array('sniadanie'),
                'startReservation' => '2015-07-30',
                'endReservation' => '2015-08-23',
                'email' => 'admin3@admin.pl'
            ),array(
                'roomNumber' => 104,
                'reservedDate' => '2015-07-25',
                'services' => array('sniadanie'),
                'startReservation' => '2015-07-25',
                'endReservation' => '2015-07-29',
                'email' => 'admin1@admin.pl'
            ),array(
                'roomNumber' => 105,
                'reservedDate' => '2015-07-13',
                'services' => array('sniadanie'),
                'startReservation' => '2015-07-13',
                'endReservation' => '2015-07-23',
                'email' => 'admin1@admin.pl'
            ),array(
                'roomNumber' => 105,
                'reservedDate' => '2015-07-13',
                'services' => array('sniadanie'),
                'startReservation' => '2015-07-13',
                'endReservation' => '2015-07-23',
                'email' => 'admin2@admin.pl'
            ),array(
                'roomNumber' => 106,
                'reservedDate' => '2015-07-13',
                'services' => array('sniadanie'),
                'startReservation' => '2015-07-13',
                'endReservation' => '2015-07-23',
                'email' => 'admin3@admin.pl'
            ),array(
                'roomNumber' => 107,
                'reservedDate' => '2015-07-13',
                'services' => array('sniadanie'),
                'startReservation' => '2015-07-13',
                'endReservation' => '2015-07-29',
                'email' => 'admin4@admin.pl'
            )
        );

        foreach ($reservations as $id => $details) {
            $Reservation = new Reservation();

            $reservedDate = date_create($details['reservedDate']);
            $startDate = date_create($details['startReservation']);
            $endReservation = date_create($details['endReservation']);

            $Reservation
                ->setReservedDate($reservedDate)
                ->setServices($details['services'])
                ->setStartReservation($startDate)
                ->setEndReservation($endReservation)
                ->setRoom($this->getReference('room_'.$details['roomNumber']))
                ->setClient($this->getReference('client_'.$details['email']))
            ;


            $manager->persist($Reservation);
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
        return 2;
    }
}