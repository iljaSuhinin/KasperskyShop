<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\CartBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sylius\Bundle\CartBundle\Resolver\ItemResolvingException;
use Sylius\Bundle\CartBundle\Controller\CartItemController as BaseCartItemController;

class CartItemController extends BaseCartItemController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function calculateAction(Request $request)
    {
        try {
            $item = $this->getResolver()->resolve($this->createNew(), $request);
            return $this->setResponse(array('UnitPrice' => $item->getUnitPrice()), 200);
        } catch (ItemResolvingException $exception) {
            return $this->setResponse(null, 500, "Can't find variant!");
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
}