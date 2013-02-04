<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\ResourceBundle\Admin\Assortment;

use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\Admin;

class ProductAdmin extends Admin
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
                ->add('image', 'sonata_type_model_list', array('required' => false), array('link_parameters'=>array('context'=>'products')))
                ->add('variants', 'sonata_type_collection',
                    array('cascade_validation' => true, 'required' => false),
                    array('edit' => 'inline', 'inline' => 'table'))
                /*->add('options', 'sonata_type_collection', array('cascade_validation' => true),
                    array('edit' => 'inline', 'inline' => 'table'))
                ->add('properties', 'sonata_type_collection', array('cascade_validation' => true),
                    array('edit' => 'inline', 'inline' => 'table'))*/
            ->end();
    }
}