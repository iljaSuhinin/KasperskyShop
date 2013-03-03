<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\AssortmentBundle\Admin;

use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

use SIP\ResourceBundle\Admin\ContainerAwareAdmin;

class VariantAdmin extends ContainerAwareAdmin
{
    /**
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagrid
     */
    protected function configureDatagridFilters(DatagridMapper $datagrid)
    {
        $datagrid
            ->add('master')
            ->add('product')
        ;
    }

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
            ->add('price', 'money')
            ->add('discounts')
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
                ->add('price', 'money')
                ->add('discounts', 'sonata_type_collection',
                    array('cascade_validation' => true, 'required' => false, 'by_reference' => false),
                    array('edit' => 'inline', 'inline' => 'table'))
                ->add('product', 'genemu_jqueryselect2_entity',
                    array('class' => $this->container->getParameter('sylius.model.product.class'),
                          'property' => 'name',
                          'attr' => array('class' => 'option_value_product')))
                ->add('options', 'option_value', array('required' => false))
            ->end();
    }
}