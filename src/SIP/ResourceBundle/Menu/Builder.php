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

        foreach ($this->getTextManager()->getTexts() as $textPage) {
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
        foreach ($this->getProductManager()->getProducts() as $product) {
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
     * @return \SIP\TextBundle\Manager\TextManager
     */
    public function getTextManager()
    {
        return $this->container->get('sip.content.text.manager');
    }

    /**
     * @return \SIP\AssortmentBundle\Manager\ProductManager
     */
    public function getProductManager()
    {
        return $this->container->get('sip_assortment.product.manager');
    }
}