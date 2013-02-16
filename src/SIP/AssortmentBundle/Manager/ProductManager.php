<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\AssortmentBundle\Manager;

class ProductManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @param \Doctrine\ORM\EntityManager $em
     * @param $modelClass
     */
    public function __construct(\Doctrine\ORM\EntityManager $em, $modelClass)
    {
        $this->em = $em;
        $this->modelClass = $modelClass;
    }

    /**
     * @return \SIP\AssortmentBundle\Entity\Product[]
     */
    public function getProducts()
    {
        return $this->getRepository()->getProductsQueryBuilder()->getQuery()->execute();
    }

    /**
     * @return \SIP\AssortmentBundle\Repository\ProductRepository
     */
    public function getRepository()
    {
        return $this->em->getRepository($this->modelClass);
    }
}