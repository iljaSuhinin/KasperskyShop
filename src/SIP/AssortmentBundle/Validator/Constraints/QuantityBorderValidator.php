<?php
/*
 * (c) Suhinin Ilja <isuhinin@armd.ru>
 */
namespace SIP\AssortmentBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

use SIP\AssortmentBundle\Entity\Discount;

class QuantityBorderValidator extends ConstraintValidator
{
    /**
     * @param Discount $value
     * @param \Symfony\Component\Validator\Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$value instanceof Discount) {
            throw new UnexpectedTypeException($value, 'SIP\AssortmentBundle\Entity\Discount');
        }

        if ($value->getMaxQuantity() && $value->getMaxQuantity() <= $value->getMinQuantity()) {
            $this->context->addViolation($constraint->message,
                array('%maxQuantity%' => $value->getMaxQuantity(),
                      '%minQuantity%' => $value->getMinQuantity()));
        }
    }
}