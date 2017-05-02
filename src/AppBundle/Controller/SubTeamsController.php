<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SubTeamsController extends Controller
{
    /**
     * This route show the sub-teams in the different poles
     * This route corresponds to "Chef d'équipe > Board SANS..." in Invision
     * @Route("/subteams")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:SubTeams:index.html.twig', array(
            // ...
        ));
    }

}
