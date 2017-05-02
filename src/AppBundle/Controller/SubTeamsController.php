<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SubTeamsController extends Controller
{
    /**
     * @Route("/subteams")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:SubTeams:index.html.twig', array(
            // ...
        ));
    }

}
