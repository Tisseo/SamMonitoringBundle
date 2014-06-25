<?php

namespace CanalTP\SamMonitoringBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class MonitoringCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition(
            'sam_monitoring_manager'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'service_monitoring'
        );
        
        foreach ($taggedServices as $id => $attributes) {
            $matches = array();
            $application = '';
            if (preg_match('/(\w*)\./', $id, $matches)) {
                $application = $matches[1];

                foreach ($attributes as $key => $value) {
                    if (isset($value['category'])) {
                        $definition->addMethodCall(
                            'addService',
                            array(new Reference($id), strtolower($application), strtolower($value['category']))
                        );
                    }
                }
            }
        }
    }
}
