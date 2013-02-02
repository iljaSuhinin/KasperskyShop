<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\ResourceBundle\Entity;

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
     * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart", orphanRemoval=true)
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
}