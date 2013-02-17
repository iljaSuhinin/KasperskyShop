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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}