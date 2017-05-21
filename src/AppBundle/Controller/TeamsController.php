<?php

namespace AppBundle\Controller;

use AppBundle\Middleware\InformationsRetrieverMiddleware;
use Monolog\Handler\SyslogUdp\UdpSocket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TeamsController extends Controller
{
    /**
     * This route shows all the teams in a specific zone
     * This route correpond to "Volontariat > Coordinateur" and is
     * available for Coordinators and Volontariat
     *
     * @Route("/teams")
     * @return mixed
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getRepository('AppBundle:User');
        //We get the current user, using the middleware
        //$currentUserId = $em->getCurrentUserId();
        $currentUserName = $em->getCurrentUserAffectationId();
        //$currentUserFirstname = $em->getCurrentUserTeamId();

        return $this->render(
            'AppBundle:Teams:index.html.twig', array(
                'current_user_name' => $currentUserName,

                )
        );
    }

}
