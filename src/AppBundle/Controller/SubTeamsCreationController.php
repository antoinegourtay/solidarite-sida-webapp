<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SubTeamsCreationController extends Controller
{
    /**
     * TODO: Check for a same controller for the whole repartition
     * @Route("/subteam-creation")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:SubTeamsCreation:index.html.twig', array(
            // ...
        ));
    }

}
