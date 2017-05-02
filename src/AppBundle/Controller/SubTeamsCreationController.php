<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SubTeamsCreationController extends Controller
{
    /**
     * @Route("/subteam-creation")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:SubTeamsCreation:index.html.twig', array(
            // ...
        ));
    }

}
