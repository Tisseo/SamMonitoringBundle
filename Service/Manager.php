<?php

namespace CanalTP\SamMonitoringBundle\Service;

use CanalTP\SamMonitoringComponent\Manager as ManagerComponent;

/**
 * Description of MonitoringManager
 *
 * @author Kévin Ziemianski <kevin.ziemianski@canaltp.fr>
 */
class Manager
{
    protected $container;
    protected $manager;
    
    public function __construct($container)
    {
        $this->container = $container;
        $this->manager = new ManagerComponent();
    }
    
    /**
     * Call during compilation phase
     * 
     * @param ServiceMonitoringInterface $service
     * @param string $application
     * @param string $category
     */
    public function addService($service, $application, $category)
    {
        //first, check if there's a component
        $appComponent = $this->getComponentByApp($application);
        if (is_null($appComponent)) {
            return null;
        }
        if (!$this->manager->hasComponent($application)) {
            $this->manager->addComponent($appComponent, $application);
        }
        
        //second, add service
        $this->manager->addService($service, $application, $category);
    }
    
    public function getComponentByApp($application)
    {
        if (!$this->container->has('sam.business_monitoring.' . $application)) {
            $this->container->get('logger')->error('Service "' . 'sam.business_monitoring.' . $application . '" not found.');
            return null;
        }
        
        $monitoring = $this->container->get('sam.business_monitoring.' . $application);
        
        return $monitoring;
    }
    
}
