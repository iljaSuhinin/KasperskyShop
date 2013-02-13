<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\AssortmentBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sonata\AdminBundle\Controller\CRUDController;

class VariantAdminController extends CRUDController
{
    public function variantOptionAction()
    {
        if (!$this->getRequest()->query->get('productId')) {
            return $this->setResponse(null, 500, 'Not passed productId');
        }

        $this->getRequest()->getSession()->set('productId', $this->getRequest()->query->get('productId'));

        $product = $this->getDoctrine()
                        ->getRepository('SIPAssortmentBundle:Product')
                        ->find($this->getRequest()->query->get('productId'));

        $builder = $this->admin->getFormBuilder();
        $builder->add('options', 'option_value', array('required' => true, 'compound' => true, 'keys' => $this->getKeys($product)));

        $view = $builder->getForm()->createView();
        $this->get('twig')->getExtension('form')->renderer->setTheme($view, $this->admin->getFormTheme());

        return $this->setResponse(
            array('content' => $this->getTemplating()->render('SIPAssortmentBundle:Form:ajax_field.html.twig',array('view' => $view)))
        );
    }

    /**
     * @param \Sylius\Bundle\AssortmentBundle\Model\ProductInterface $product
     * @return array
     */
    public function getKeys(\Sylius\Bundle\AssortmentBundle\Model\ProductInterface $product)
    {
        $variantOptions = array();
        if ($id = $this->getRequest()->query->get('id')) {
            $variantOptions = $this->admin->getObject($id)->getOptions();
        }

        $keys = array();
        /** @var \Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface $option */
        foreach ($product->getOptions() as $option) {
            $choices = array();
            $data = null;
            foreach ($option->getValues() as $value) {
                foreach ($variantOptions as $variantOption) {
                    if ($variantOption->getId() == $value->getId()) {
                        $data = $variantOption->getId();
                    }
                }
                $choices[$value->getId()] = $value->getValue();
            }

            $keys[] = array("option_{$option->getId()}", 'genemu_jqueryselect2_choice',
                array('label' => $option->getName(), 'choices' => $choices, 'data' => $data));
        }

        return $keys;
    }

    /**
     * @throws \RuntimeException
     */
    public function configure()
    {
        $this->admin = $this->container->get('sonata.admin.pool')->getAdminByAdminCode('sip.assortment.variant.admin');

        if (!$this->admin) {
            throw new \RuntimeException(sprintf('Unable to find the admin class related to the current controller (%s)', get_class($this)));
        }

        $rootAdmin = $this->admin;

        if ($this->admin->isChild()) {
            $this->admin->setCurrentChild(true);
            $rootAdmin = $rootAdmin->getParent();
        }

        $request = $this->container->get('request');

        $rootAdmin->setRequest($request);

        if ($request->query->get('uniqId')) {
            $this->admin->setUniqid($request->query->get('uniqId'));
        }
    }

    /**
     * @param array $data
     * @param int $code
     * @param string $error
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function setResponse(array $data = null, $code = 200, $error = '')
    {
        return new Response(
            json_encode(array(
                'data' => $data? $data: null,
                'status' => $code,
                'error' => $error,
            )),
            $code,
            array('Content-Type' => 'application/json')
        );
    }

    /**
     * @return \Symfony\Bundle\TwigBundle\Debug\TimedTwigEngine
     */
    public function getTemplating()
    {
        return $this->container->get('templating');
    }
}