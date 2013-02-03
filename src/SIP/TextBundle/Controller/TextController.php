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
        $entity = $this->getDoctrine()
                       ->getRepository($this->container->getParameter('sip.text.model.class'))
                       ->findOneBy(array('slug' => $slug, 'disabled' => false));

        if (!$entity) {
            throw $this->createNotFoundException("Unable to find entity");
        }

        return $this->render('SIPTextBundle:Text:index.html.twig', array('entity' => $entity));
    }
}
