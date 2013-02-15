<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\CartBundle\Resolver;

use Doctrine\Common\Persistence\ObjectRepository;
use Sylius\Bundle\CartBundle\Model\CartItemInterface;
use Sylius\Bundle\CartBundle\Resolver\ItemResolverInterface;
use Sylius\Bundle\CartBundle\Resolver\ItemResolvingException;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;

class ItemResolver implements ItemResolverInterface
{
    /**
     * Product manager.
     *
     * @var ObjectRepository
     */
    private $productRepository;

    /**
     * Form factory.
     *
     * @var FormFactory
     */
    private $formFactory;

    /**
     * Constructor.
     *
     * @param ObjectRepository $productRepository
     * @param FormFactory      $formFactory
     */
    public function __construct(ObjectRepository $productRepository, FormFactory $formFactory)
    {
        $this->productRepository = $productRepository;
        $this->formFactory = $formFactory;
    }

    /**
     * {@inheritdoc}
     *
     * Here we create the item that is going to be added to cart, basing on the current request.
     * This method simply has to return false value if something is wrong.
     */
    public function resolve(CartItemInterface $item, Request $request)
    {
        /*
         * We're getting here product id via query but you can easily override route
         * pattern and use attributes, which are available through request object.
         */
        if (!$id = $request->query->get('id')) {
            throw new ItemResolvingException('Error while trying to add item to cart');
        }

        if (!$product = $this->productRepository->find($id)) {
            throw new ItemResolvingException('Requested product was not found');
        }

        if (!$request->isMethod('POST')) {
            throw new ItemResolvingException('Wrong request method');
        }

        // We use forms to easily set the quantity and pick variant but you can do here whatever is required to create the item.
        $form = $this->formFactory->create('sylius_cart_item', null, array('product' => $product));

        $form->bind($request);
        $item = $form->getData(); // Item instance, cool.

        // If our product has no variants, we simply set the master variant of it.
        if (!$product->hasOptions()) {
            $item->setVariant($product->getMasterVariant());
        }

        $variant = $item->getVariant();

        // If all is ok with form, quantity and other stuff, simply return the item.
        if ($form->isValid() && null !== $variant) {
            return $item;
        }

        throw new ItemResolvingException('Submitted form is invalid');
    }
}