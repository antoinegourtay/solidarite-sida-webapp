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

        return $this->render('@EventBundle/dashboard.html.twig', [
            'zoneRepository' => $this->get('ZoneRepository'),
            'teamRepository' => $this->get('TeamRepository'),
            'poleRepository' => $this->get('PoleRepository'),
            'subteamRepository' => $this->get('SubteamRepository'),
            'peopleRepository'  => $this->get('PeopleRepository'),
        ]);
    }
}
