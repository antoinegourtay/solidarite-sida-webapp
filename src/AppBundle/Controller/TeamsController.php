<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TeamsController extends Controller
{
    /**
     * @Route("/teams")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Teams:index.html.twig', array(
            // ...
        ));
    }

}
