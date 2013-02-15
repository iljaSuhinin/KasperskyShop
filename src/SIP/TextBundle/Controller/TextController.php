<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\TextBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TextController extends Controller
{
    /**
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function indexAction($slug)
    {
        if (!$entity = $this->getTextManager()->getText($slug)) {
            throw $this->createNotFoundException("Unable to find entity");
        }

        return $this->render('SIPTextBundle:Text:index.html.twig', array('entity' => $entity));
    }

    /**
     * @return \SIP\TextBundle\Manager\TextManager
     */
    public function getTextManager()
    {
        return $this->container->get('sip.content.text.manager');
    }
}
