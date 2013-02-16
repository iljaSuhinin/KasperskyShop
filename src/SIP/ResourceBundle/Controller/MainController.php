<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\ResourceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $recentProducts = $this
            ->getProductRepository()
            ->findBy(array('onMain' => 1), array('updatedAt' => 'desc'), 8);

        $recentNews = $this
            ->getNewsRepository()
            ->findBy(array('onMain' => 1), array('date' => 'desc'), 8);

        return $this->render('SIPResourceBundle:Main:index.html.twig',
            array('recentProducts' => $recentProducts,
                  'recentNews'     => $recentNews));
    }

    /**
     * @return \SIP\AssortmentBundle\Repository\ProductRepository
     */
    private function getProductRepository()
    {
        return $this->get('sylius.repository.product');
    }

    /**
     * @return \SIP\NewsBundle\Repository\NewsRepository
     */
    private function getNewsRepository()
    {
        return $this->get('sip_news.repository.new');
    }
}