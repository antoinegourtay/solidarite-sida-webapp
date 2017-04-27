<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ZoneCoordinatorController extends Controller
{
    /**
     * @Route("zone-coordinator")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:ZoneCoordinator:index.html.twig', array(
            // ...
        ));
    }

}
