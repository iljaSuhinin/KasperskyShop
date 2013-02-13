<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\AssortmentBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class OptionValueType extends AbstractType
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function setContainer (\Symfony\Component\DependencyInjection\ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
     */
    public function getDoctrine()
    {
        return $this->container->get('doctrine');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {
        return $this->container->get('request');
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new ArrayToOptionCollectionTransformer($this->getDoctrine()->getEntityManager());

        $builder->addModelTransformer($transformer);

        if ($this->checkSession()) {
            $product = $this->getDoctrine()->getEntityManager()
                            ->getRepository('SIPAssortmentBundle:Product')
                            ->find($this->getRequest()->getSession()->get('productId'));

            foreach ($product->getOptions() as $option) {
                $choices = array();
                $data = null;
                foreach ($option->getValues() as $value) {
                    $choices[$value->getId()] = $value->getValue();
                }

                $builder->add("option_{$option->getId()}", 'genemu_jqueryselect2_choice',
                    array('label' => $option->getName(), 'choices' => $choices));
            }
        }
    }

    /**
     * @param \Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface $variant
     * @return \Sylius\Bundle\AssortmentBundle\Model\ProductInterface
     */
    public function getProduct(\Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface $variant)
    {
        if ($this->checkSession()) {
            return $this->getDoctrine()->getRepository('SIPAssortmentBundle:Product')
                ->find($this->getRequest()->getSession()->get('productId'));
        }

        return $variant->getProduct();
    }

    /**
     * @return bool
     */
    public function checkSession()
    {
        return $this->getRequest()->getSession()->has('productId') &&
            $this->getRequest()->getSession()->get('productId') &&
            $this->getRequest()->getMethod() == 'POST';
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        if ($this->checkSession()) {
            $options = array('compound' => true, 'attr' => array('class' => 'option_value_target-quiet'));
        } else {
            $options = array('compound' => false, 'attr' => array('class' => 'option_value_target'));
        }

        $resolver->setDefaults($options);
    }

    public function getParent()
    {
        return 'sonata_type_immutable_array';
    }

    public function getName()
    {
        return 'option_value';
    }
}