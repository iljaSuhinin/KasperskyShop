<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\ResourceBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav'
            )
        ));

        $menu->addChild('Products', array('route' => 'sip_assortment_product_list'));

        $childOptions = array(
            'attributes'         => array('class' => 'dropdown'),
            'childrenAttributes' => array('class' => 'dropdown-menu'),
            'labelAttributes'    => array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'href' => '#')
        );

        $menu->addChild('Offers', array('route' => 'sip_news_list'));

        $child = $menu->addChild('Text pages', $childOptions);

        $textPages = $this->getTextRepository()->findBy(array('disabled' => 0));
        foreach ($textPages as $textPage) {
            $child->addChild($textPage->getTitle(), array(
                'route'           => 'sip_text_item',
                'routeParameters' => array(
                    'slug'  => $textPage->getSlug()
                ),
                'labelAttributes' => array('icon' => 'icon-chevron-right')
            ));
        }

        return $menu;
    }

    /**
     * @param \Knp\Menu\FactoryInterface $factory
     * @return \Knp\Menu\ItemInterface
     */
    public function sidebarMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array(
                'class' => 'nav'
            )
        ));

        $menu->setCurrent($this->container->get('request')->getRequestUri());

        $childOptions = array(
            'childrenAttributes' => array('class' => 'nav nav-list'),
            'labelAttributes'    => array('class' => 'nav-header')
        );

        $currentCategory = null;
        $child = null;
        foreach ($this->getProductRepository()->getProducts() as $product) {
            if ($currentCategory != $product->getCategory()) {
                $currentCategory = $product->getCategory();
                $child = $menu->addChild($currentCategory->getTitle(), $childOptions);
            }

            if ($child) {
                $child->addChild($product->getName(), array(
                    'route'           => 'sip_assortment_product_show',
                    'routeParameters' => array('slug' => $product->getSlug()),
                    'labelAttributes' => array('icon' => ' icon-caret-right')
                ));
            }
        }

        return $menu;
    }

    /**
     * @return \Sylius\Bundle\AssortmentBundle\Entity\CustomizableProductRepository
     */
    public function getTextRepository()
    {
        return $this->container->get('sip_text.repository.text');
    }

    /**
     * @return \SIP\AssortmentBundle\Repository\ProductRepository
     */
    private function getProductRepository()
    {
        return $this->container->get('sylius.repository.product');
    }
}