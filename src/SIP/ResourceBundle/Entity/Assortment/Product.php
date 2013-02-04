<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\ResourceBundle\Entity\Assortment;

use Doctrine\ORM\Mapping as ORM;

use Sylius\Bundle\AssortmentBundle\Entity\CustomizableProduct as BaseProduct;

/**
 * @ORM\Entity
 * @ORM\Table(name="content_product")
 * @ORM\HasLifecycleCallbacks
 */
class Product extends BaseProduct
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface", mappedBy="product", orphanRemoval=true)
     */
    protected $variants;

    /**
     * @ORM\OneToMany(targetEntity="Sylius\Bundle\AssortmentBundle\Model\Property\ProductPropertyInterface", mappedBy="product", orphanRemoval=true)
     */
    protected $properties;

    /**
     * @ORM\ManyToOne(targetEntity="SIP\ResourceBundle\Entity\Media\Media")
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    protected $image;

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