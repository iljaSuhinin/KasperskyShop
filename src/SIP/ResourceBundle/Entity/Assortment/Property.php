<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\ResourceBundle\Entity\Assortment;

use Doctrine\ORM\Mapping as ORM;

use Sylius\Bundle\AssortmentBundle\Entity\Property\Property as BaseProperty;

/**
 * @ORM\Entity
 * @ORM\Table(name="content_property")
 * @ORM\HasLifecycleCallbacks
 */
class Property extends BaseProperty
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\PreUpdate
     */
    public function setUpdateAt()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return mixed|string
     */
    public function __toString()
    {
        return $this->getName();
    }
}