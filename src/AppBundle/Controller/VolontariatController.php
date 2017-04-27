<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class VolontariatController extends Controller
{
    /**
     * @Route("volontariat")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Volontariat:index.html.twig', array(
            // ...
        ));
    }

}
