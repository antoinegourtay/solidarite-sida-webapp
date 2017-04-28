<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ZoneController extends Controller
{
    /**
     * @Route("/zones")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Zone:index.html.twig', array(
            // ...
        ));
    }

}
