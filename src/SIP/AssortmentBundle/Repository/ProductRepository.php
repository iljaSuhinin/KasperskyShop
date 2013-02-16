<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\AssortmentBundle\Repository;

use Sylius\Bundle\AssortmentBundle\Entity\CustomizableProductRepository;

class ProductRepository extends CustomizableProductRepository
{
    /**
     * @param $slug
     * @return \Pagerfanta\Pagerfanta
     */
    public function getProductByCategory($slug, $criteria, $orderBy)
    {
        $queryBuilder = $this->getCollectionQueryBuilder();

        $queryBuilder
            ->innerJoin("{$this->getAlias()}.category", 'c')
            ->andWhere('c.slug = :slug')
            ->setParameter('slug', $slug);

        $this->applyCriteria($queryBuilder, $criteria);
        $this->applySorting($queryBuilder, $orderBy);

        return $this->getPaginator($queryBuilder);
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getProductsQueryBuilder()
    {
        $queryBuilder = $this->getCollectionQueryBuilder();
        $queryBuilder->innerJoin("{$this->getAlias()}.category", 'c')
                     ->orderBy('c.position', 'ASC');

        $this->applyCriteria($queryBuilder, array('disabled' => 0));

        return $queryBuilder;
    }
}