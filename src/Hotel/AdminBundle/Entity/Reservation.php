<?php

namespace Hotel\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservations")
 * @ORM\Entity(repositoryClass="Hotel\AdminBundle\Entity\ReservationRepository")
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="reserved_date", type="datetime")
     */
    private $reservedDate;
    /**
     * @ORM\Column(name="date_for_reservation", type="datetime")
     */
    private $dateForReservation;
    /**
     * @ORM\Column(name="date_for_end_of_reservation", type="datetime")
     */
    private $dateForEndOfReservation;
    /**
     * @ORM\Column(type="array")
     */
    private $services;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel\AdminBundle\Entity\Room", inversedBy="reservations")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="room_id")
     */
    private $room;

    /**
     * @ORM\OneToOne(targetEntity="Hotel\AdminBundle\Entity\Client", inversedBy="reservation")
     */
    private $client;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reservedDate
     *
     * @param \DateTime $reservedDate
     * @return Reservation
     */
    public function setReservedDate($reservedDate)
    {
        $this->reservedDate = $reservedDate;

        return $this;
    }

    /**
     * Get reservedDate
     *
     * @return \DateTime 
     */
    public function getReservedDate()
    {
        return $this->reservedDate;
    }

    /**
     * Set dateForReservation
     *
     * @param \DateTime $dateForReservation
     * @return Reservation
     */
    public function setDateForReservation($dateForReservation)
    {
        $this->dateForReservation = $dateForReservation;

        return $this;
    }

    /**
     * Get dateForReservation
     *
     * @return \DateTime 
     */
    public function getDateForReservation()
    {
        return $this->dateForReservation;
    }

    /**
     * Set dateForEndOfReservation
     *
     * @param \DateTime $dateForEndOfReservation
     * @return Reservation
     */
    public function setDateForEndOfReservation($dateForEndOfReservation)
    {
        $this->dateForEndOfReservation = $dateForEndOfReservation;

        return $this;
    }

    /**
     * Get dateForEndOfReservation
     *
     * @return \DateTime 
     */
    public function getDateForEndOfReservation()
    {
        return $this->dateForEndOfReservation;
    }

    /**
     * Set services
     *
     * @param array $services
     * @return Reservation
     */
    public function setServices($services)
    {
        $this->services = $services;

        return $this;
    }

    /**
     * Get services
     *
     * @return array 
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Set room
     *
     * @param \Hotel\AdminBundle\Entity\Room $room
     * @return Reservation
     */
    public function setRoom(\Hotel\AdminBundle\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Hotel\AdminBundle\Entity\Room 
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set client
     *
     * @param \Hotel\AdminBundle\Entity\Client $client
     * @return Reservation
     */
    public function setClient(\Hotel\AdminBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Hotel\AdminBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }
}
