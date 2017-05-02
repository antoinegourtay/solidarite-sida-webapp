<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PoleCreationController extends Controller
{
    /**
     * @Route("/pole-creation")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:PoleCreation:index.html.twig', array(
            // ...
        ));
    }

}
