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
     * @var \Doctrine\Bundle\DoctrineBundle\Registry
     */
    protected $doctrine;

    /**
     * @param \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     */
    public function setDoctrine(\Doctrine\Bundle\DoctrineBundle\Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new ArrayToOptionCollectionTransformer($this->doctrine->getEntityManager());

        $builder->addModelTransformer($transformer);

        if (isset($options['object'])) {
            /**
             * @var \Sylius\Bundle\AssortmentBundle\Model\Variant\VariantInterface $variant
             */
            if (($variant = $options['object']) && $variant->getProduct()) {
                /**
                 * @var \Sylius\Bundle\AssortmentBundle\Model\Option\OptionInterface $option
                 */
                foreach ($variant->getProduct()->getOptions() as $option) {
                    $choices = array();
                    $data = null;
                    foreach ($option->getValues() as $value) {
                        foreach ($variant->getOptions() as $variantOptionValue) {
                            if ($variantOptionValue == $value) {
                                $data = $variantOptionValue->getId();
                            }
                        }

                        $choices[$value->getId()] = $value->getValue();
                    }

                    $builder->add("option_{$option->getId()}", 'genemu_jqueryselect2_choice',
                        array('label' => $option->getName(), 'choices' => $choices, 'data' => $data));
                }
            }
        }
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $options = array('compound' => true);

        $resolver->setRequired(array(
            'object',
        ));

        $resolver->setAllowedTypes(array(
            'object' => 'SIP\AssortmentBundle\Entity\Variant',
        ));

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