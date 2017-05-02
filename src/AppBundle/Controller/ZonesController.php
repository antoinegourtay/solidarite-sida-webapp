<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ZonesController extends Controller
{
    /**
     * @Route("/zones")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Zones:index.html.twig', array(
            // ...
        ));
    }

}
