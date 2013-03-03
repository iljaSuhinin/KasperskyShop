<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\AssortmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use SIP\AssortmentBundle\Validator\Constraints\QuantityBorder;

/**
 * @ORM\Entity
 * @ORM\Table(name="content_discount")
 * @QuantityBorder
 */
class Discount
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Variant price.
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    protected $price = 0.00;

    /**
     * @ORM\Column(type="integer", name="min_quantity")
     * @Assert\NotBlank
     * @Assert\Min(limit=1)
     */
    protected $minQuantity;

    /**
     * @ORM\Column(type="integer", name="max_quantity", nullable=true)
     * @Assert\Min(limit=1)
     */
    protected $maxQuantity;

    /**
     * @ORM\ManyToOne(targetEntity="Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface", inversedBy="discounts")
     * @ORM\JoinColumn(name="variant_id", referencedColumnName="id")
     * @Assert\NotNull
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
     * Set price
     *
     * @param float $price
     * @return Discount
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set minQuantity
     *
     * @param integer $minQuantity
     * @return Discount
     */
    public function setMinQuantity($minQuantity)
    {
        $this->minQuantity = $minQuantity;
    
        return $this;
    }

    /**
     * Get minQuantity
     *
     * @return integer 
     */
    public function getMinQuantity()
    {
        return $this->minQuantity;
    }

    /**
     * Set maxQuantity
     *
     * @param integer $maxQuantity
     * @return Discount
     */
    public function setMaxQuantity($maxQuantity)
    {
        $this->maxQuantity = $maxQuantity;
    
        return $this;
    }

    /**
     * Get maxQuantity
     *
     * @return integer 
     */
    public function getMaxQuantity()
    {
        return $this->maxQuantity;
    }

    /**
     * Set variant
     *
     * @param \SIP\AssortmentBundle\Entity\Variant $variant
     * @return Discount
     */
    public function setVariant(\SIP\AssortmentBundle\Entity\Variant $variant = null)
    {
        $this->variant = $variant;
    
        return $this;
    }

    /**
     * Get variant
     *
     * @return \SIP\AssortmentBundle\Entity\Variant 
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "{$this->getMinQuantity()}-{$this->getMaxQuantity()}: {$this->getPrice()}";
    }
}