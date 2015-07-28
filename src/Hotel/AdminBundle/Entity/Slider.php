<?php

namespace Hotel\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Slider
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Hotel\AdminBundle\Entity\SliderRepository")
 */
class Slider
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
     * @ORM\ManyToOne(targetEntity="Hotel\AdminBundle\Entity\News", inversedBy="slider")
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id")
     */
    private $news;

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
     * Set news
     *
     * @param \Hotel\AdminBundle\Entity\News $news
     * @return Slider
     */
    public function setNews(\Hotel\AdminBundle\Entity\News $news = null)
    {
        $this->news = $news;

        return $this;
    }

    /**
     * Get news
     *
     * @return \Hotel\AdminBundle\Entity\News 
     */
    public function getNews()
    {
        return $this->news;
    }
}
