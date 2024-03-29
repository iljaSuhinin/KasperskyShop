<?php

namespace SIP\CartBundle\Form\Type;

use Sylius\Bundle\CartBundle\Form\Type\CartItemType as BaseCartItemType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * We extend the item form type a bit, to add a variant select field
 * when we're adding product to cart, but not when we edit quantity in cart.
 * We'll use simple option for that, passing the product instance required by
 * variant choice type.
 *
 * @author Paweł Jędrzejewkski <pjedrzejewski@diweb.pl>
 */
class CartItemType extends BaseCartItemType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        if (isset($options['product']) && $options['product']->hasOptions()) {
            $type = $options['product']->isVariantPickingModeChoice() ? 'sylius_variant_choice' : 'sylius_variant_match';

            $builder->add('variant', $type, array(
                'product'  => $options['product']
            ));
        }
    }

    /**
     * We need to override this method to allow setting 'product'
     * option, by default it will be null so we don't get the variant choice
     * when creating full cart form.
     *
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $validationGroups = function (Options $options) {
            if (isset($options['product'])) {
                return $options['product']->hasOptions() ? 'CheckVariant' : null;
            }
        };

        $resolver
            ->setDefaults(array(
                'validation_groups' => $validationGroups
            ))
            ->setOptional(array(
                'product'
            ))
            ->setAllowedTypes(array(
                'product' => array('Sylius\Bundle\AssortmentBundle\Model\CustomizableProductInterface')
            ))
        ;
    }
}
