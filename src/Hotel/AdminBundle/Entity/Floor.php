<?php

namespace Hotel\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Floor
 *
 * @ORM\Table(name="floors")
 * @ORM\Entity(repositoryClass="Hotel\AdminBundle\Entity\FloorRepository")
 */
class Floor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="floor_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="floor_floor", type="integer", length=7)
     */
    private $floor;

    /**
     * @ORM\OneToMany(targetEntity="Hotel\AdminBundle\Entity\Room", mappedBy="floor")
     */
    private $rooms;

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
        $this->rooms = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set floor
     *
     * @param integer $floor
     * @return Floor
     */
    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Get floor
     *
     * @return integer 
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Add rooms
     *
     * @param \Hotel\AdminBundle\Entity\Room $rooms
     * @return Floor
     */
    public function addRoom(\Hotel\AdminBundle\Entity\Room $rooms)
    {
        $this->rooms[] = $rooms;

        return $this;
    }

    /**
     * Remove rooms
     *
     * @param \Hotel\AdminBundle\Entity\Room $rooms
     */
    public function removeRoom(\Hotel\AdminBundle\Entity\Room $rooms)
    {
        $this->rooms->removeElement($rooms);
    }

    /**
     * Get rooms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRooms()
    {
        return $this->rooms;
    }
}
