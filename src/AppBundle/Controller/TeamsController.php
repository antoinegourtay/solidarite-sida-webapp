<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TeamsController extends Controller
{
    /**
     * This route shows all the teams in a specific zone
     * This route correpond to "Volontariat > Coordinateur" and is available for Coordinators and Volontariat
     * @Route("/teams")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Teams:index.html.twig', array(
            // ...
        ));
    }

}
