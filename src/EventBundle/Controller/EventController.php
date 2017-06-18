<?php
namespace EventBundle\Controller;

use EventBundle\Entity\Pole;
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

        return $this->render('@EventBundle/zones.html.twig', [
            'zones' => $this->get('zoneRepository')->findAll(),
        ]);
    }

    /**
     * @Route("/zone/{zone}", name="zone", requirements={"zone": "\d+"})
     * @Method({ "GET" })
     */
    public function teamsAction(Request $request, $zone)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('@EventBundle/teams.html.twig', [
            'zoneId' => $zone,
            'teams'  => $this->get('teamRepository')->findBy(['zone_id' => $zone]),
        ]);
    }

    /**
     * @Route("/team/{team}", name="team", requirements={"team": "\d+"})
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

    /**
     * @Route("/pole/{pole}", name="pole", requirements={"pole": "\d+"})
     * @Method({ "GET" })
     */
    public function subteamsActions(Request $request, $pole)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('@EventBundle/subteams.html.twig', [
            'poleId'    => $pole,
            'subteams'  => $this->get('subteamRepository')->findBy(['pole_id' => $pole]),
        ]);
    }

    /**
     * @Route("/pole/create/{team}", name="pole_create", requirements={"team": "\d+"})
     * @Method({ "GET" })
     */
    public function createPoleAction($team)
    {
        return $this->render('@EventBundle/pole.create.html.twig', [
            'team' => $team,
        ]);
    }

    /**
     * @Route("/pole/create/validate", name="pole_create_validate")
     * @Method({ "POST" })
     */
    public function createPoleValidateAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $teamId = $request->request->get('team');
        $poleNames = json_decode($request->request->get('poles'));
        $team = $this->get('teamRepository')->findBy(['id' => $teamId]);

        if (empty($team)) {
            return $this->redirectToRoute('dashboard');
        }

        foreach ($poleNames as $poleName) {
            $pole = new Pole();
            $pole->setName($poleName);
            $pole->setTeam($team[0]);
            $em->persist($pole);
            $em->flush();
        }

        return $this->redirectToRoute('team', ['team' => $teamId]);
    }
}
