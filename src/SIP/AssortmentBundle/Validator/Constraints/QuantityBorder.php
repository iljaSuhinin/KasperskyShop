<?php
/*
 * (c) Suhinin Ilja <isuhinin@armd.ru>
 */
namespace SIP\AssortmentBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class QuantityBorder extends Constraint
{
    public $message = 'MaxQuantity: "%maxQuantity% must be more MinQuantity: "%minQuantity%".';

    /**
     * @return string
     */
    public function validatedBy()
    {
        return 'sip.assortment.validator.quantity_border';
    }

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}