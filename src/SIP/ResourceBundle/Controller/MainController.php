<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\ResourceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('SIPResourceBundle:Main:index.html.twig');
    }
}