<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\AssortmentBundle\Admin;

use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use SIP\ResourceBundle\Admin\ContainerAwareAdmin;
use SIP\AssortmentBundle\Entity\Product;

class ProductAdmin extends ContainerAwareAdmin
{
    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('name')
            ->add('slug')
            ->add('description')
            ->add('image')
            ->add('variants')
            ->add('options')
            ->add('properties')
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
            ->addIdentifier('name')
            ->add('slug')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('image', 'sonata_type_model', array('template'=>'SIPResourceBundle:Admin:list_image.html.twig'))
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
                ->add('name')
                ->add('slug')
                ->add('description')
                ->add('variantPickingMode', 'genemu_jqueryselect2_choice',
                    array('choices' => array(Product::VARIANT_PICKING_CHOICE => 'VARIANT_PICKING_CHOICE',
                                             Product::VARIANT_PICKING_MATCH => 'VARIANT_PICKING_MATCH')))
                ->add('image', 'sonata_type_model_list', array('required' => false), array('link_parameters'=>array('context'=>'products')))
                ->add('properties', 'sonata_type_collection',
                    array('cascade_validation' => true, 'required' => false, 'by_reference' => false),
                    array('edit' => 'inline', 'inline' => 'table'))
                ->add('options', 'genemu_jqueryselect2_entity',
                    array('class' => $this->container->getParameter('sylius.model.option.class'),
                          'property' => 'name', 'multiple' => true))
            ->end();
    }
}