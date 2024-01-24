<?php

namespace Leuz\JitsiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface 
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('jitsi_meet');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('jitsi')
                    ->children()
                        ->scalarNode('api_key')->isRequired()->end()
                        ->scalarNode('app_id')->isRequired()->end()
                        ->scalarNode('iss')->defaultValue('chat')->end()
                        ->scalarNode('aud')->defaultValue('jitsi')->end()
                    ->end()
                ->end()
            ->end();
        return $treeBuilder;
    }
}