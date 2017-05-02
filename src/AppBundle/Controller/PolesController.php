<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PolesController extends Controller
{
    /**
     * This route show all the poles in a Team
     * @Route("/poles")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Poles:index.html.twig', array(
            // ...
        ));
    }

}
