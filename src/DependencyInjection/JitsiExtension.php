<?php

namespace Leuz\JitsiBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class JitsiExtension extends Extension
{
    function load(array $configs, ContainerBuilder $container)
    {
        // Load the bundle's service declarations 
        // $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        // $loader->load('services.yaml');

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../../config'));
        $loader->load('service.xml');

        $option = $this->processConfiguration(new Configuration(), $configs);

        $jitsiDefinition = $container->getDefinition('jitsi.jws.builder');

        $jitsiDefinition->replaceArgument(0, $option['jitsi']['api_key']);
        $jitsiDefinition->replaceArgument(1, $option['jitsi']['app_id']);
        $jitsiDefinition->replaceArgument(2, $option['jitsi']['iss']);
        $jitsiDefinition->replaceArgument(3, $option['jitsi']['aud']);
    }
}