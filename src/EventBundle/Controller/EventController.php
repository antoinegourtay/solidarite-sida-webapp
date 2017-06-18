<?php
namespace EventBundle\Controller;

use EventBundle\Entity\Pole;
use EventBundle\Entity\Subteam;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $teamId = $request->request->get('team');
        $poleNames = json_decode($request->request->get('poles'));
        $poleNames = array_filter($poleNames, function ($current) { return !empty($current); });
        $team = $this->get('teamRepository')->findBy(['id' => $teamId]);

        if (empty($poleNames)) {
            return $this->redirectToRoute('pole_create', ['team' => $teamId]);
        }

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

    /**
     * @Route("/subteam/create/{pole}", name="subteam_create", requirements={"pole": "\d+"})
     * @Method({ "GET" })
     */
    public function createSubteamAction($pole)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('@EventBundle/subteam.create.html.twig', [
            'pole' => $pole,
        ]);
    }

    /**
     * @Route("/subteam/create/validate", name="subteam_create_validate")
     * @Method({ "POST" })
     */
    public function createSubteamValidateAction(Request $request)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $poleId = $request->request->get('pole');
        $subteamNames = json_decode($request->request->get('subteams'));
        $subteamNames = array_filter($subteamNames, function ($current) { return !empty($current); });
        $pole = $this->get('poleRepository')->findBy(['id' => $poleId]);

        if (empty($subteamNames)) {
            return $this->redirectToRoute('subteam_create', ['pole' => $poleId]);
        }

        if (empty($pole)) {
            return $this->redirectToRoute('dashboard');
        }

        foreach ($subteamNames as $subteamName) {
            $subteam = new Subteam();
            $subteam->setName($subteamName);
            $subteam->setPole($pole[0]);
            $em->persist($subteam);
            $em->flush();
        }

        return $this->redirectToRoute('pole', ['pole' => $poleId]);
    }

    /**
     * @Route("/team/edit/{team}", name="zone_edit")
     * @Method({ "GET" })
     */
    public function editSubteamAction(Request $request, $team)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('@EventBundle/subteam.edit.html.twig', [
            'teamId' => $team
        ]);
    }

    /**
     * @Route("/api/team/{team}/people/available/{subteam}", name="api_team_available_people")
     * @Method({ "GET" })
     */
    public function apiTeamPeopleAction(Request $request, $team, $subteam)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        $people = $this->get('PeopleRepository')->getFromTeamIdAndNotSubteamId($team, $subteam);
        $people = array_reduce($people, function ($previous, $person) {
            $previous[] = [
                'name'    => $person->getFirstName() .' '. $person->getLastName(),
                'id'      => $person->getId(),
            ];
            return $previous;
        }, []);
        return new JsonResponse(['people' => $people]);
    }

    /**
     * @Route("/api/team/{team}", name="api_team")
     * @Method({ "GET" })
     */
    public function apiTeamAction(Request $request, $team)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        $poles = $this->get('PoleRepository')->findBy(['team_id' => $team]);
        $poles = array_reduce($poles, function ($previous, $pole) {
            $previous[] = ['name' => $pole->getName(), 'id' => $pole->getId()];
            return $previous;
        }, []);
        return new JsonResponse(['poles' => $poles]);
    }

    /**
     * @Route("/api/pole/{pole}", name="api_pole")
     * @Method({ "GET" })
     */
    public function apiPoleAction(Request $request, $pole)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        $subteams = $this->get('SubteamRepository')->findBy(['pole_id' => $pole]);
        $subteams = array_reduce($subteams, function ($previous, $subteam) {
            $previous[] = ['name' => $subteam->getName(), 'id' => $subteam->getId()];
            return $previous;
        }, []);
        return new JsonResponse(['subteams' => $subteams]);
    }

    /**
     * @Route("/api/subteam/{subteam}/people", name="api_subteam_people")
     * @Method({ "GET" })
     */
    public function apiSubteamAction(Request $request, $subteam)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        $people = $this->get('PeopleRepository')->findBy(['subteam_id' => $subteam]);
        $people = array_reduce($people, function ($previous, $person) use ($subteam) {
            $previous[] = [
                'name'    => $person->getFirstName() .' '. $person->getLastName(),
                'id'      => $person->getId(),
                'chief'   => !empty($this->get('SubteamHasChiefRepository')->findBy(['people_id' => $person->getId(), 'subteam_id' => $subteam])),
                'adjoint' => !empty($this->get('SubteamHasAdjointRepository')->findBy(['people_id' => $person->getId(), 'subteam_id' => $subteam])),
            ];
            return $previous;
        }, []);
        return new JsonResponse(['people' => $people]);
    }

    /**
     * @Route("/api/subteam/{subteam}/people/{people}", name="api_subteam_people_add")
     * @Method({ "POST" })
     */
    public function apiSubteamAddAction(Request $request, $subteam, $people)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $people = $this->get('PeopleRepository')->findBy(['id' => $people]);
        $subteam = $this->get('SubteamRepository')->findBy(['id' => $subteam]);

        if (empty($people) || empty($subteam)) {
            return new JsonResponse(['error' => true]);
        }

        $people[0]->setSubteam($subteam[0]);
        $em->persist($people[0]);
        $em->flush();

        return new JsonResponse(['error' => false]);
    }
}
