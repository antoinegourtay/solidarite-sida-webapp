<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TrombinoscopeController extends Controller
{
    /**
     * @Route("/trombinoscope")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Trombinoscope:index.html.twig', array(
            // ...
        ));
    }

}
