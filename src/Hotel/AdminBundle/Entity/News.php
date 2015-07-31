<?php

namespace Hotel\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="Hotel\AdminBundle\Entity\NewsRepository")
 *
 * @UniqueEntity(fields={"title"})
 */
class News
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
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=120, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=120, unique=true)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     *
     */
    private $thumbnail;

    /**
     * @ORM\OneToMany(targetEntity="Hotel\AdminBundle\Entity\Slider", mappedBy="news")
     */
    private $slider;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", name="create_date")
     */
    private $createDate;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime", name="modified_date")
     */
    private $modifiedDate;



//    /**
//     * @ORM\ManyToOne(targetEntity="Hotel\AdminBundle\Entity\Category", inversedBy="news")
//     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
//     */
//    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Hotel\AdminBundle\Entity\User", inversedBy="news")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    private $author;

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
     * Set title
     *
     * @param string $title
     * @return News
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return News
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Get createDate
     *
     * @return \DateTime 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }


    /**
     * Get modifiedDate
     *
     * @return \DateTime 
     */
    public function getModifiedDate()
    {
        return $this->modifiedDate;
    }

    /**
     * Set author
     *
     * @param \Hotel\AdminBundle\Entity\User $author
     * @return News
     */
    public function setAuthor(\Hotel\AdminBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Hotel\AdminBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->slider = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return News
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Set thumbnail
     *
     * @param string $thumbnail
     * @return News
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return string 
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return News
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;

        return $this;
    }

    /**
     * Set modifiedDate
     *
     * @param \DateTime $modifiedDate
     * @return News
     */
    public function setModifiedDate($modifiedDate)
    {
        $this->modifiedDate = $modifiedDate;

        return $this;
    }

    /**
     * Add slider
     *
     * @param \Hotel\AdminBundle\Entity\Slider $slider
     * @return News
     */
    public function addSlider(\Hotel\AdminBundle\Entity\Slider $slider)
    {
        $this->slider[] = $slider;

        return $this;
    }

    /**
     * Remove slider
     *
     * @param \Hotel\AdminBundle\Entity\Slider $slider
     */
    public function removeSlider(\Hotel\AdminBundle\Entity\Slider $slider)
    {
        $this->slider->removeElement($slider);
    }

    /**
     * Get slider
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSlider()
    {
        return $this->slider;
    }
}
