<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PoleCreationController extends Controller
{
    /**
     * TODO: Check for a same controller for the whole repartition
     * @Route("/pole-creation")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:PoleCreation:index.html.twig', array(
            // ...
        ));
    }

}
