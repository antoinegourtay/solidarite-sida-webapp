<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class VolontariatController extends Controller
{
    /**
     * @Route("volontariat")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Volontariat:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("volontariat/zones")
     */
    public function zoneAction()
    {
        return $this->render('AppBundle:Volontariat:zones.html.twig', array(

        ));
    }

    public function coordinatorAction()
    {
        return $this->render('AppBundle:Volontariat:coordinators.html.twig', array(

        ));
    }
}
