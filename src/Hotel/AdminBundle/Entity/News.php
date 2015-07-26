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
     * @ORM\Column(type="string", length=120, unique=true)
     * @Assert\NotBlank()
     */
    private $title;
    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=120, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

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
     * @ORM\JoinColumn(name="news_id", referencedColumnName="id")
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
}
