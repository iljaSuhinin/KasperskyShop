<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\AssortmentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Sylius\Bundle\AssortmentBundle\Entity\CustomizableProduct as BaseProduct;

/**
 * @ORM\Entity
 * @ORM\Table(name="content_product")
 * @ORM\HasLifecycleCallbacks
 */
class Product extends BaseProduct
{
    const VARIANT_PICKING_CHOICE = 0;
    const VARIANT_PICKING_MATCH  = 1;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface",
     * mappedBy="product", orphanRemoval=true, cascade={"persist", "remove"})
     */
    protected $variants;

    /**
     * @ORM\OneToMany(targetEntity="Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface",
     * mappedBy="product", cascade={"persist", "remove"})
     */
    protected $properties;

    /**
     * @ORM\ManyToOne(targetEntity="SIP\ResourceBundle\Entity\Media\Media")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    protected $image;

    /**
     * Variant picking mode.
     * Whether to display a choice form with all variants or match variant for
     * given options.
     *
     * @ORM\Column(type="integer", name="variant_picking_mode")
     */
    protected $variantPickingMode = 1;

    public function __construct()
    {
        parent::__construct();
        $this->properties = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set image
     *
     * @param \Sonata\MediaBundle\Model\MediaInterface $image
     * @return Product
     */
    public function setImage(\Sonata\MediaBundle\Model\MediaInterface $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Sonata\MediaBundle\Model\MediaInterface
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param \Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface $propertie
     * @return Product
     */
    public function addPropertie(\Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface $propertie)
    {
        $this->properties[] = $propertie;

        return $this;
    }

    /**
     * @param \Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface $propertie
     */
    public function removePropertie(\Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface $propertie)
    {
        $this->properties->removeElement($propertie);
    }

    public function getVariantPickingMode()
    {
        return $this->variantPickingMode;
    }

    public function setVariantPickingMode($variantPickingMode)
    {
        if (!in_array($variantPickingMode, array(self::VARIANT_PICKING_CHOICE, self::VARIANT_PICKING_MATCH))) {
            throw new \InvalidArgumentException('Wrong variant picking mode supplied');
        }

        $this->variantPickingMode = $variantPickingMode;
    }

    public function isVariantPickingModeChoice()
    {
        return self::VARIANT_PICKING_CHOICE === $this->variantPickingMode;
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