<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\AssortmentBundle\Admin;

use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use SIP\ResourceBundle\Admin\ContainerAwareAdmin;

class VariantAdmin extends ContainerAwareAdmin
{
    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('price')
            ->add('master')
            ->add('presentation')
            ->add('product')
            ->add('options')
            ->add('availableOn')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('deletedAt')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('price')
            ->add('master')
            ->add('presentation')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                'view' => array(),
                'edit' => array(),
                'delete' => array(),
            )));
    }

    /**
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     *
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
                ->add('presentation')
                ->add('price')
                ->add('product', 'genemu_jqueryselect2_entity',
                    array('class' => $this->container->getParameter('sylius.model.product.class'), 'property' => 'name'))
                ->add('options', 'genemu_jqueryselect2_entity',
                    array('class' => 'Sylius\Bundle\AssortmentBundle\Entity\Option\DefaultOptionValue', 'property' => 'name'))
            ->end();
    }
}