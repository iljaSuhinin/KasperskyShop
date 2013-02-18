<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface;
use Sylius\Bundle\CartBundle\Model\CartItemInterface;
use Sylius\Bundle\CartBundle\Entity\CartItem as BaseCartItem;
use Symfony\Component\Validator\Constraints as Assert;

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
     * Variant.
     *
     * @Assert\NotBlank(groups={"CheckVariant"})
     * @ORM\ManyToOne(targetEntity="Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface")
     * @ORM\JoinColumn(name="variant_id", referencedColumnName="id", nullable=false)
     */
    protected $variant;

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
     * Get associated variant.
     *
     * @return VariantInterface
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * Set associated variant.
     *
     * @param VariantInterface $variant
     */
    public function setVariant(VariantInterface $variant)
    {
        $this->variant = $variant;

        $this->setUnitPrice($variant->getPrice());
    }

    /**
     * {@inheritdoc}
     */
    public function equals(CartItemInterface $item)
    {
        return $this->getVariant()->getId() === $item->getVariant()->getId();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getVariant()->getPresentation();
    }
}