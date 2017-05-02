<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LandingTrombinoscopeController extends Controller
{
    /**
     * This route correspond to the first landing on the trombinoscope for a team leader
     * This route corresponds to "Chef d'équipe > Premier Trombinoscope" in Invision
     * This route is only available for Team Leaders
     * @Route("/landing-trombi")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:LandingTrombinoscope:index.html.twig', array(
            // ...
        ));
    }

}
