<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\AssortmentBundle\Controller;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends ResourceController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listByCategoryAction(Request $request, $slug)
    {
        $config = $this->getConfiguration();

        $resources = $this->getRepository()
                          ->getProductByCategory($slug, $config->getCriteria(), $config->getSorting())
                          ->setCurrentPage($request->get('page', 1), true, true)
                          ->setMaxPerPage($config->getPaginationMaxPerPage());

        $view = $this
            ->view()
            ->setTemplate($this->getFullTemplateName('index.html'))
            ->setTemplateVar($config->getPluralResourceName())
            ->setData($resources)
        ;

        return $this->handleView($view);
    }
}