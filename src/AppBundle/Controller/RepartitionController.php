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
        $userService = $this->get('app.service.user_data_service');
        return $this->render('AppBundle:Repartition:index.html.twig', array(
            'currentUser' => $userService->getCurrentUserConnectedId(),
        ));
    }

}
