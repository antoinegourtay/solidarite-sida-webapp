<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PrintController extends Controller
{
    /**
     * @Route("/print")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Print:index.html.twig', array(
            // ...
        ));
    }

}
