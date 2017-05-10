<?php

namespace AppBundle\Controller;

use Monolog\Handler\SyslogUdp\UdpSocket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Middleware\InformationsRetrieverMiddleware;

class TeamsController extends Controller
{
    /**
     * This route shows all the teams in a specific zone
     * This route correpond to "Volontariat > Coordinateur" and is available for Coordinators and Volontariat
     * @Route("/teams")
     */
    public function indexAction()
    {
        //We get the currend user, using the middleware
        $currentUser = InformationsRetrieverMiddleware::getCurrentUser();
        $currentUserId = InformationsRetrieverMiddleware::getCurrentUserId();

        return $this->render('AppBundle:Teams:index.html.twig', array(
            'current_user_id' => $currentUserId,
        ));
    }

}
