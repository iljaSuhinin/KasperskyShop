<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Sylius\Bundle\CartBundle\Entity\Cart as BaseCart;

/**
 * @ORM\Entity
 * @ORM\Table(name="sip_content_cart")
 */
class Cart extends BaseCart
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart", orphanRemoval=true, cascade={"persist"})
     */
    protected $items;

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
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getTotal() . '-Expired at:' . $this->getExpiresAt()->format('Y.d.m h:i');
    }
}