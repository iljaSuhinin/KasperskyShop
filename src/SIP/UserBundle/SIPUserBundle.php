<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SIPUserBundle extends Bundle
{
    public function getParent()
    {
        return 'SonataUserBundle';
    }
}
