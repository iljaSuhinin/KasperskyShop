<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\ResourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use SIP\NewsBundle\Entity\News as BaseNews;

/**
 * @ORM\Entity
 * @ORM\Table(name="content_news")
 * @Gedmo\Loggable(logEntryClass="SIP\ResourceBundle\Entity\ContentLog")
 */
class News extends BaseNews
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $date;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="string")
     */
    protected $slug;

    /**
     * @ORM\ManyToOne(targetEntity="SIP\ResourceBundle\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

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
     * Set category
     *
     * @param \SIP\ResourceBundle\Entity\Category $category
     * @return News
     */
    public function setCategory(\SIP\ResourceBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \SIP\ResourceBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}