<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\TextBundle\Manager;

class TextManager
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @param \Doctrine\ORM\EntityManager $em
     * @param $modelClass
     */
    public function __construct(\Doctrine\ORM\EntityManager $em, $modelClass)
    {
        $this->em = $em;
        $this->modelClass = $modelClass;
    }

    /**
     * @param string $slug
     * @return \SIP\TextBundle\Entity\Text
     */
    public function getText($slug)
    {
        return $this->em->getRepository($this->modelClass)->findOneBy(array('slug' => $slug, 'disabled' => false));
    }

    /**
     * @return \SIP\TextBundle\Entity\Text[]
     */
    public function getTexts()
    {
        return $this->em->getRepository($this->modelClass)->findBy(array('disabled' => false));
    }
}