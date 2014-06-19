<?php

namespace CanalTP\SamMonitoringBundle\Service;

/**
 * Description of MonitoringManager
 *
 * @author Kévin Ziemianski <kevin.ziemianski@canaltp.fr>
 */
class MonitoringManager
{
    protected $container;
    
    public function __construct($container)
    {
        $this->container = $container;
    }
    
    public function getMonitoringForApp($application)
    {
        if (!$this->container->has($application.'-monitoring')) {
            return null;
        }
        
        $monitoring = $this->container->get($application.'-monitoring');
        
        return $monitoring;
    }
}
