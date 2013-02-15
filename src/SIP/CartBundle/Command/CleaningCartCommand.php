<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\CartBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CleaningCartCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('sip:cleaning_cart')->setDescription('
            Комманда для удаления из корзины просроченных заявок.
            Необходимо добавить вызов комманды в cron.
        ');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $deleteElements = $this->getEntityManager()->createQueryBuilder('c')
             ->select('c')
             ->from($this->getContainer()->getParameter('sylius_cart.model.cart.class'), 'c')
             ->where('c.expiresAt < :now')->setParameter('now', new \DateTime())
             ->getQuery()->execute();

        $deleteCount = count($deleteElements);

        foreach ($deleteElements as $deleteElement) {
            $this->getEntityManager()->remove($deleteElement);
        }

        $this->getEntityManager()->flush();

        $output->writeln("Удаленно {$deleteCount} устаревших заявок");
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->getContainer()->get('doctrine.orm.entity_manager');
    }
}