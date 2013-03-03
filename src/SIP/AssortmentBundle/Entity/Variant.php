<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\AssortmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

use SIP\AssortmentBundle\Validator\Constraints\QuantityBorder;
use Sylius\Bundle\AssortmentBundle\Entity\Variant\Variant as BaseVariant;

/**
 * @ORM\Entity
 * @ORM\Table(name="content_variant")
 * @ORM\HasLifecycleCallbacks
 */
class Variant extends BaseVariant
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
    protected $price;

    /**
     * @ORM\OneToMany(targetEntity="SIP\AssortmentBundle\Entity\Discount",
     * mappedBy="variant", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Assert\All({
     *     @QuantityBorder
     * })
     */
    protected $discounts;

    public function __construct()
    {
        parent::__construct();

        $this->discounts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->price = 0.00;
    }

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
     * Get price.
     *
     * @return float
     */
    public function getPrice($quantity = null)
    {
        if ($quantity && $this->hasDiscounts()) {
            $discount = $this->getDiscount($quantity);
            return $discount? $discount->getPrice(): $this->price;
        }

        return $this->price;
    }

    /**
     * Set price.
     *
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdateAt()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get discounts
     *
     * @return \SIP\AssortmentBundle\Entity\Discount[]
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }

    /**
     * Set discounts
     *
     * @param array $discounts
     * @return Variant
     */
    public function setDiscounts(array $discounts = array())
    {
        $this->discounts = $discounts;

        return $this;
    }

    /**
     * Add discounts
     *
     * @param \SIP\AssortmentBundle\Entity\Discount $discounts
     * @return Variant
     */
    public function addDiscount(\SIP\AssortmentBundle\Entity\Discount $discounts)
    {
        $this->discounts[] = $discounts;
        $discounts->setVariant($this);
    
        return $this;
    }

    /**
     * Remove discounts
     *
     * @param \SIP\AssortmentBundle\Entity\Discount $discounts
     */
    public function removeDiscount(\SIP\AssortmentBundle\Entity\Discount $discounts)
    {
        $this->discounts->removeElement($discounts);
    }

    /**
     * @return bool
     */
    public function hasDiscounts()
    {
        return 0 !== $this->getDiscounts()->count();
    }

    /**
     * @param $quantity
     * @return null|Discount
     */
    public function getDiscount($quantity)
    {
        foreach ($this->getDiscounts() as $discount) {
            if ($discount->getMinQuantity() <= $quantity && $quantity <= $discount->getMaxQuantity()) {
                return $discount;
            }

            if ($discount->getMinQuantity() <= $quantity && !$discount->getMaxQuantity()) {
                return $discount;
            }
        }

        return null;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getPresentation()? (string)$this->getPresentation():
            "{$this->getProduct()->getName()} - {$this->getPrice()}";
    }
}