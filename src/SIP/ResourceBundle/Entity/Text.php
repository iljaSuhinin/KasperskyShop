<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\ResourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use SIP\TextBundle\Entity\Text as BaseText;

/**
 * @ORM\Entity
 * @ORM\Table(name="content_text")
 * @Gedmo\Loggable(logEntryClass="SIP\ResourceBundle\Entity\ContentLog")
 */
class Text extends BaseText
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
     * @ORM\Column(type="text")
     */
    protected $body;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="string")
     */
    protected $slug;

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