<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\ResourceBundle\Admin;

use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Admin\Admin;

class ContentLogAdmin extends Admin
{
    /**
     * @var \Sonata\AdminBundle\Admin\Pool
     */
    protected $adminPoll;

    /**
     * @param string $code
     * @param string $class
     * @param string $baseControllerName
     */
    public function __construct($code, $class, $baseControllerName, \Sonata\AdminBundle\Admin\Pool $adminPoll)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->adminPoll = $adminPoll;
    }

    /**
     * @param \Sonata\AdminBundle\Show\ShowMapper $showMapper
     *
     * @return void
     */
    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('action')
            ->add('loggedAt')
            ->add('objectClass')
            ->add('version')
            ->add('username')
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
            ->addIdentifier('loggedAt')
            ->add('action')
            ->add('objectClass')
            ->add('version')
            ->add('username')
            ->add('_action', 'actions', array(
            'actions' => array(
                'view' => array(),
                'edit' => array(),
                'delete' => array(),
                'url' => array('template' => 'SIPResourceBundle:Admin:list__action_url.html.twig'))
        ));
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
            ->add('action')
            ->add('loggedAt')
            ->add('objectClass')
            ->add('version')
            ->add('data', 'sonata_type_immutable_array', array('keys' => $this->getContentLogData()))
            ->add('username')
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('action')
            ->add('objectClass')
            ->add('version')
            ->add('username')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Route\RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('edit');
        $collection->remove('delete');
    }

    /**
     * @return array
     */
    public function getContentLogData()
    {
        $outData = array();
        if ( ($data = $this->getSubject()->getData()) && is_array($data) ) {
            if ( isset($data['lastLogin']) ) {
                $outData['lastLogin'] = array('lastLogin', 'datetime', array('required' => false));
            }

            if ( isset($data['roles']) ) {
                $outData['roles'] = array('roles', 'collection', array('required' => false));
            }
        }
        return $outData;
    }

    /**
     * @param string $entityClass
     * @return \Sonata\AdminBundle\Admin\Admin
     */
    public function getAdminClass($entityClass)
    {
        return $this->adminPoll->getAdminByClass($entityClass);
    }
}