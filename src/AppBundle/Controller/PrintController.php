<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PrintController extends Controller
{
    /**
     * This controller is used for generating pdf with specific informations and parameters
     * @Route("/print")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Print:index.html.twig', array(
            // ...
        ));
    }

}
