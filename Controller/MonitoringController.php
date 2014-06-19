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
        var_dump($version);
        var_dump($application);
        var_dump($format);
        die(__CLASS__ . ' : ' . __LINE__);
    }
}
