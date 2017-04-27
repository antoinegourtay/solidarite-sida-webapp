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

    /**
     * @Route("/chef-equipe/create-pole")
     */
    public function createPoleAction(){

        return $this->render('AppBundle:TeamChief:createpole.html.twig', array(

        ));
    }

}
