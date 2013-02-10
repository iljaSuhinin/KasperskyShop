<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\AssortmentBundle\Form\Type;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use SIP\AssortmentBundle\Form\Type\OptionValueType;

class ArrayToOptionCollectionTransformer implements DataTransformerInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $om;

    /**
     * @param \Doctrine\ORM\EntityManager $om
     */
    public function __construct(\Doctrine\ORM\EntityManager $om)
    {
        $this->om = $om;
    }

    /**
     * @param \Sylius\Bundle\AssortmentBundle\Model\Option\OptionValueInterface $OptionValue
     * @return mixed|void
     */
    public function transform($OptionValues)
    {
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $OptionValues
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function reverseTransform($OptionValues)
    {
        $qb = $this->om->getRepository('Sylius\Bundle\AssortmentBundle\Entity\Option\DefaultOptionValue')
                       ->createQueryBuilder('v')->select('v');

        $valuesIds = array();
        foreach ($OptionValues as $OptionValue) {
            if (!is_object($OptionValue)) {
                $valuesIds[] = $OptionValue;
            }
        }

        if (!empty($valuesIds)) {
            return new ArrayCollection($qb->where($qb->expr()->in('v.id', $valuesIds))->getQuery()->getResult());
        }

        return $OptionValues;
    }
}