<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\CartBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SIPCartBundle extends Bundle
{
    /**
     * @return string
     */
    public function getParent()
    {
        return "SyliusCartBundle";
    }
}
