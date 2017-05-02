<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RepartitionController extends Controller
{
    /**
     * TODO: Check for a same controller for the whole repartition
     * @Route("/repartition")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Repartition:index.html.twig', array(
            // ...
        ));
    }

}
