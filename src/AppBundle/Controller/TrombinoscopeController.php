<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TrombinoscopeController extends Controller
{
    /**
     * This page shows the trombinoscope of all volunteers with their informations
     * This page is available for everyone and correspond to "Chef d'équipe" > Trombi in Invision
     * @Route("/trombinoscope")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Trombinoscope:index.html.twig', array(
            // ...
        ));
    }

}
