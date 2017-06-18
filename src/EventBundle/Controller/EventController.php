<?php
namespace EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class EventController extends Controller
{
    /**
     * @Route("/dashboard", name="dashboard")
     * @Method({ "GET" })
     */
    public function dashboardAction(Request $request)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        if (empty($this->get('PeopleRepository')->findBy(['admin' => false]))) {
            return $this->redirectToRoute('import');
        }

        return $this->redirectToRoute('zones');
    }

    /**
     * @Route("/zones", name="zones")
     * @Method({ "GET" })
     */
    public function zonesAction(Request $request)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('@EventBundle/zones.html.twig');
    }

    /**
     * @Route("/zone/{zone}", name="zone", requirements={"zone": "\d+")
     * @Method({ "GET" })
     */
    public function teamsAction(Request $request, $zone)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('@EventBundle/teams.html.twig', [
            'zoneId' => $zone,
        ]);
    }

    /**
     * @Route("/team/{team}", name="team", requirements={"team": "\d+")
     * @Method({ "GET" })
     */
    public function polesActions(Request $request, $team)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('@EventBundle/poles.html.twig', [
            'teamId' => $team,
            'poles'  => $this->get('poleRepository')->findBy(['team_id' => $team]),
        ]);
    }
}
