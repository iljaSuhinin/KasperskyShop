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

    const PRODUCT_VIEW_HOME = 0;
    const PRODUCT_VIEW_OFFICE  = 1;

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
     * @ORM\JoinColumn(name="preview_id", referencedColumnName="id", nullable=true)
     */
    protected $preview;

    /**
     * @ORM\ManyToOne(targetEntity="SIP\ResourceBundle\Entity\Media\Media")
     * @ORM\JoinColumn(name="fullview_id", referencedColumnName="id", nullable=true)
     */
    protected $fullview;

    /**
     * @ORM\ManyToOne(targetEntity="SIP\ResourceBundle\Entity\Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\Column(type="text")
     */
    protected $brief;

    /**
     * @ORM\Column(type="text")
     */
    protected $links;

    /**
     * @ORM\Column(type="text")
     */
    protected $information;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $disabled;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $onMain;

    /**
     * @ORM\Column(type="integer")
     */
    protected $sku;

    /**
     * @ORM\Column(type="integer")
     */
    protected $view = self::PRODUCT_VIEW_HOME;

    /**
     * Variant picking mode.
     * Whether to display a choice form with all variants or match variant for
     * given options.
     *
     * @ORM\Column(type="integer", name="variant_picking_mode")
     */
    protected $variantPickingMode = self::VARIANT_PICKING_MATCH;

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
     * Set preview
     *
     * @param \SIP\ResourceBundle\Entity\Media\Media $preview
     * @return Product
     */
    public function setPreview(\SIP\ResourceBundle\Entity\Media\Media $preview = null)
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * Get preview
     *
     * @return \SIP\ResourceBundle\Entity\Media\Media
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * Set fullview
     *
     * @param \SIP\ResourceBundle\Entity\Media\Media $fullview
     * @return Product
     */
    public function setFullview(\SIP\ResourceBundle\Entity\Media\Media $fullview = null)
    {
        $this->fullview = $fullview;

        return $this;
    }

    /**
     * Get fullview
     *
     * @return \SIP\ResourceBundle\Entity\Media\Media
     */
    public function getFullview()
    {
        return $this->fullview;
    }

    /**
     * Set category
     *
     * @param \Sonata\MediaBundle\Model\MediaInterface $category
     * @return Product
     */
    public function setCategory(\SIP\ResourceBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \SIP\ResourceBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
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
     * Set brief
     *
     * @param string $brief
     * @return Product
     */
    public function setBrief($brief)
    {
        $this->brief = $brief;
    
        return $this;
    }

    /**
     * Get brief
     *
     * @return string 
     */
    public function getBrief()
    {
        return $this->brief;
    }

    /**
     * Set links
     *
     * @param string $links
     * @return Product
     */
    public function setLinks($links)
    {
        $this->links = $links;
    
        return $this;
    }

    /**
     * Get links
     *
     * @return string 
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set information
     *
     * @param string $information
     * @return Product
     */
    public function setInformation($information)
    {
        $this->information = $information;
    
        return $this;
    }

    /**
     * Get information
     *
     * @return string 
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set disabled
     *
     * @param boolean $disabled
     * @return Product
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
    
        return $this;
    }

    /**
     * Get disabled
     *
     * @return boolean 
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Set onMain
     *
     * @param boolean $onMain
     * @return Product
     */
    public function setOnMain($onMain)
    {
        $this->onMain = $onMain;
    
        return $this;
    }

    /**
     * Get onMain
     *
     * @return boolean 
     */
    public function getOnMain()
    {
        return $this->onMain;
    }

    /**
     * Set sku
     *
     * @param integer $sku
     * @return Product
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    
        return $this;
    }

    /**
     * Get sku
     *
     * @return integer 
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set view
     *
     * @param integer $view
     * @return Product
     */
    public function setView($view)
    {
        $this->view = $view;
    
        return $this;
    }

    /**
     * Get view
     *
     * @return integer 
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}