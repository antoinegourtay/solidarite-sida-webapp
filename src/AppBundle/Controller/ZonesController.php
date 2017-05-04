<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ZonesController extends Controller
{
    /**
     * This route is for Volontariat
     * This route shows all the zones of the festival
     * This page correspond to "Volontariat" in Invision
     * @Route("/zones")
     */
    public function indexAction()
    {
        //We get the current user
        $currentUser = $this->getUser();
        return $this->render('AppBundle:Zones:index.html.twig', array(
            // ...
        ));
    }

}
