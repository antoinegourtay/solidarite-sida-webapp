<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class RepartitionController extends Controller
{
    /**
     * @Route("/repartition")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Repartition:index.html.twig', array(
            // ...
        ));
    }

}
