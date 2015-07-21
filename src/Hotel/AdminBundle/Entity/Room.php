<?php

namespace Hotel\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="rooms")
 * @ORM\Entity(repositoryClass="Hotel\AdminBundle\Entity\RoomRepository")
 */
class Room
{
    /**
     * @var integer
     *
     * @ORM\Column(name="room_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(name="number_of_people", type="integer", length=2)
     */
    private $numberOfPeople;
    /**
     * @ORM\Column(name="for_smoking_people", type="boolean")
     */
    private $forSmokingPeople;
    /**
     * @ORM\Column(name="room_number", type="string", length=5)
     */
    private $roomNumber;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel\AdminBundle\Entity\Floor", inversedBy="rooms")
     * @ORM\JoinColumn(name="floor_id", referencedColumnName="floor_id")
     */
    private $floor;

    /**
     * @ORM\OneToMany(targetEntity="Hotel\AdminBundle\Entity\Reservation", mappedBy="room")
     */
    private $reservations;

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
     * Constructor
     */
    public function __construct()
    {
        $this->reservations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set numberOfPeople
     *
     * @param integer $numberOfPeople
     * @return Room
     */
    public function setNumberOfPeople($numberOfPeople)
    {
        $this->numberOfPeople = $numberOfPeople;

        return $this;
    }

    /**
     * Get numberOfPeople
     *
     * @return integer 
     */
    public function getNumberOfPeople()
    {
        return $this->numberOfPeople;
    }

    /**
     * Set forSmokingPeople
     *
     * @param boolean $forSmokingPeople
     * @return Room
     */
    public function setForSmokingPeople($forSmokingPeople)
    {
        $this->forSmokingPeople = $forSmokingPeople;

        return $this;
    }

    /**
     * Get forSmokingPeople
     *
     * @return boolean 
     */
    public function getForSmokingPeople()
    {
        return $this->forSmokingPeople;
    }

    /**
     * Set roomNumber
     *
     * @param string $roomNumber
     * @return Room
     */
    public function setRoomNumber($roomNumber)
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }

    /**
     * Get roomNumber
     *
     * @return string 
     */
    public function getRoomNumber()
    {
        return $this->roomNumber;
    }

    /**
     * Set floor
     *
     * @param \Hotel\AdminBundle\Entity\Floor $floor
     * @return Room
     */
    public function setFloor(\Hotel\AdminBundle\Entity\Floor $floor = null)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Get floor
     *
     * @return \Hotel\AdminBundle\Entity\Floor 
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Add reservations
     *
     * @param \Hotel\AdminBundle\Entity\Reservation $reservations
     * @return Room
     */
    public function addReservation(\Hotel\AdminBundle\Entity\Reservation $reservations)
    {
        $this->reservations[] = $reservations;

        return $this;
    }

    /**
     * Remove reservations
     *
     * @param \Hotel\AdminBundle\Entity\Reservation $reservations
     */
    public function removeReservation(\Hotel\AdminBundle\Entity\Reservation $reservations)
    {
        $this->reservations->removeElement($reservations);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReservations()
    {
        return $this->reservations;
    }
}
