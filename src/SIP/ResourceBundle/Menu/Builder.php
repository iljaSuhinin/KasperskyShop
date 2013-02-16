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

        return $menu;
    }

    /**
     * @return \SIP\TextBundle\Manager\TextManager
     */
    public function getTextManager()
    {
        return $this->container->get('sip.content.text.manager');
    }
}