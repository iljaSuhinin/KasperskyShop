<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\ResourceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Sylius\Bundle\CartBundle\Entity\CartItem as BaseCartItem;

/**
 * @ORM\Entity
 * @ORM\Table(name="sip_content_cart_item")
 */
class CartItem extends BaseCartItem
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