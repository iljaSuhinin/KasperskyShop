<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\ResourceBundle\Admin;

use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

use SIP\NewsBundle\Admin\NewsAdmin as BaseNewsAdmin;

class NewsAdmin extends BaseNewsAdmin
{
    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     *
     * @return void
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('slug')
            ->add('onMain')
            ->add('date')
            ->add('category')
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
                ->add('title')
                ->add('slug')
                ->add('onMain')
                ->add('date', 'genemu_jquerydate', array('widget' => 'single_text', 'required' => false))
                ->add('brief', 'genemu_tinymce')
                ->add('description', 'genemu_tinymce')
                ->add('link', 'url')
                ->add('category', 'genemu_jqueryselect2_entity',
                    array('class' => 'SIP\ResourceBundle\Entity\Category', 'property' => 'title', 'required' => false))
                ->add('image', 'sonata_type_model_list', array('required' => false), array('link_parameters'=>array('context'=>'news')))
            ->end();
    }
}