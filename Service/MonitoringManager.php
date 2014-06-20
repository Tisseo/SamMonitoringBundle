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
    
    public function getComponentByApp($application)
    {
        if (!$this->container->has('sam.business_monitoring.' . $application)) {
            return null;
        }
        
        $monitoring = $this->container->get('sam.business_monitoring.' . $application);
        
        return $monitoring;
    }
    
    public function addService($service, $application, $category)
    {
        $component = $this->getComponentByApp($application);
        if (is_null($component)) return;
        
        $category = $component->getCategoryByName($category);
        
        $category->addService($service);
    }
}
