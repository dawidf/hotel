<?php

namespace Hotel\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use PUGX\ExtraValidatorBundle\Validator\Constraints as ExtraAssert;


/**
 * Reservation
 *
 * @ORM\Table(name="reservations")
 * @ORM\Entity(repositoryClass="Hotel\AdminBundle\Entity\ReservationRepository")
 * @ORM\HasLifecycleCallbacks()
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
     * @ExtraAssert\MinDate(limit="today")
     * @Assert\NotBlank()
     * @ORM\Column(name="start_reservation", type="datetime")
     */
    protected $startReservation;
    /**
     * @ExtraAssert\MinDate(limit="today")
     * @Assert\NotBlank()
     * @ORM\Column(name="end_reservation", type="datetime")
     */
    protected $endReservation;
    /**
     * @ORM\Column(type="array")
     */
    private $services;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="Hotel\AdminBundle\Entity\Room", inversedBy="reservations")
     * @ORM\JoinColumn(name="room_id", referencedColumnName="room_id")
     */
    private $room;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel\AdminBundle\Entity\User", inversedBy="reservations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

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
     * Set $startReservation
     *
     * @param \DateTime $startReservation
     * @return Reservation
     */
    public function setDateForReservation($startReservation)
    {
        $this->dateForReservation = $startReservation;

        return $this;
    }

    /**
     * Get dateForReservation
     *
     * @return \DateTime 
     */
    public function getDateForReservation()
    {
        return $this->startReservation;
    }

    /**
     * Set dateForEndOfReservation
     *
     * @param \DateTime $endReservation
     * @return Reservation
     */
    public function setDateForEndOfReservation($endReservation)
    {
        $this->dateForEndOfReservation = $endReservation;

        return $this;
    }

    /**
     * Get dateForEndOfReservation
     *
     * @return \DateTime 
     */
    public function getDateForEndOfReservation()
    {
        return $this->endReservation;
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
     * @param \Hotel\AdminBundle\Entity\User $client
     * @return Reservation
     */
    public function setClient(\Hotel\AdminBundle\Entity\User $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Hotel\AdminBundle\Entity\User
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @ORM\PrePersist()
     */
    public function setCurrentDateTime()
    {
        if($this->reservedDate == null)
        {
            $this->reservedDate = new \DateTime();
        }

    }

    /**
     * Set startReservation
     *
     * @param \DateTime $startReservation
     * @return Reservation
     */
    public function setStartReservation($startReservation)
    {
        $this->startReservation = $startReservation;

        return $this;
    }

    /**
     * Get startReservation
     *
     * @return \DateTime 
     */
    public function getStartReservation()
    {

        return $this->startReservation;
    }

    /**
     * Set forDays
     *
     * @param integer $forDays
     * @return Reservation
     */
    public function setForDays($forDays)
    {
        $this->forDays = $forDays;

        return $this;
    }

    /**
     * Get forDays
     *
     * @return integer 
     */
    public function getForDays()
    {
        return $this->forDays;
    }

    /**
     * Set endReservation
     *
     * @param \DateTime $endReservation
     * @return Reservation
     */
    public function setEndReservation($endReservation)
    {
        $this->endReservation = $endReservation;

        return $this;
    }

    /**
     * Get endReservation
     *
     * @return \DateTime 
     */
    public function getEndReservation()
    {
        return $this->endReservation;
    }

    /**
     * Set user
     *
     * @param \Hotel\AdminBundle\Entity\User $user
     * @return Reservation
     */
    public function setUser(\Hotel\AdminBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Hotel\AdminBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
