<?php

namespace CanalTP\SamMonitoringBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Description of SamController
 *
 * @author Kévin Ziemianski <kevin.ziemianski@canaltp.fr>
 */
class MonitoringController extends Controller
{
    public function applicationStatusAction($version, $application, $format)
    {
        try {
            $mM = $this->container->get('sam_monitoring_manager');
            $monitoring = $mM->getMonitoringForApp($application);
        } catch (\Exception $ex) {
            $monitoring['applicationName'] = $application;
            $monitoring['applicationState'] = \CanalTP\SamMonitoringComponent\MonitoringStateInterface::UNKNOWN;
            
            $reponse = $this->render('CanalTPSamMonitoringBundle::index.' . $format . '.twig', array('monitoring' => $monitoring));
            $reponse->headers->set('Content-Type', 'text/' . $format);
            
            return $reponse;
        }
        
        
        $reponse = $this->render('CanalTPSamMonitoringBundle::index.' . $format . '.twig', array('monitoring' => $monitoring));
        $reponse->headers->set('Content-Type', 'text/' . $format);
        
        return $reponse;
        
    }
}
