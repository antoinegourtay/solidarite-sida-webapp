<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TeamChiefController extends Controller
{
    /**
     * @Route("/chef-equipe")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:TeamChief:index.html.twig', array(
            // ...
        ));
    }

}
