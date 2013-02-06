<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\ResourceBundle\Entity\Assortment;

use Doctrine\ORM\Mapping as ORM;

use Sylius\Bundle\AssortmentBundle\Entity\Option\Option as BaseOption;

/**
 * @ORM\Entity
 * @ORM\Table(name="content_option")
 * @ORM\HasLifecycleCallbacks
 */
class Option extends BaseOption
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface",
     * mappedBy="option", orphanRemoval=true, cascade={"persist"})
     */
    protected $values;

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
     * @ORM\PreUpdate
     */
    public function setUpdateAt()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}