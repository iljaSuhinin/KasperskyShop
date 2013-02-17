<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\TextBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sip_text');

        $rootNode
            ->children()
                ->scalarNode('class')->defaultValue('SIP\\ResourceBundle\\Entity\\Text')->end()
                ->scalarNode('controller')->defaultValue('Sylius\\Bundle\\ResourceBundle\\Controller\\ResourceController')->end()
                ->scalarNode('repository')->defaultValue('Sylius\\Bundle\\ResourceBundle\\Doctrine\\ORM\\EntityRepository')->end()
                ->scalarNode('admin')->defaultValue('SIP\\TextBundle\\Admin\\TextAdmin')->end()
            ->end();

        return $treeBuilder;
    }
}