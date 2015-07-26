<?php

namespace Hotel\AdminBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * RoomRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RoomRepository extends EntityRepository
{
    public function getAvalibleRooms($params = array())
    {
        $date = $params['date'];

        $qb = $this->createQueryBuilder('room_repository')
            ->select('room_repository', 'reservations')
            ->leftJoin('room_repository.reservations', 'reservations')
            ->where("reservations.startReservation <= :date")
            ->andWhere(":date <= reservations.endReservation")
                ->setParameter(':date', $date)
            ->andWhere('room_repository.numberOfPeople = :numberOfPeople')
                ->setParameter('numberOfPeople', $params['numberOfPeople'])
        ;

        return count($qb->getQuery()->getArrayResult());
    }

    public function countRooms($room)
    {

//        $qb = $entityManager->createQueryBuilder();
//        $qb->select('count(account.id)');
//        $qb->from('ZaysoCoreBundle:Account','account');
//
//        $count = $qb->getQuery()->getSingleScalarResult();


        $qb = $this->createQueryBuilder('room_repository')
            ->select('count(room_repository.id)')
            ->where('room_repository.numberOfPeople = :numberOfPeople')
                ->setParameter('numberOfPeople', $room)

        ;

        $qb = (int)$qb->getQuery()->getSingleScalarResult();

        return $qb;
    }
}
