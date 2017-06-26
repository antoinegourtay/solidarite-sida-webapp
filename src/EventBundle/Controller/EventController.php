<?php
namespace EventBundle\Controller;

use EventBundle\Entity\Pole;
use EventBundle\Entity\Subteam;
use EventBundle\Entity\SubteamHasAdjoint;
use PeopleBundle\Helper\RoleHelper;
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

        if ($this->get('CurrentUser')->get()->getRole() === RoleHelper::VOLONTARIA) {
            if (empty($this->get('PeopleRepository')->findBy(['admin' => false]))) {
                return $this->redirectToRoute('import');
            }

            return $this->redirectToRoute('zones');
        }

        if ($this->get('CurrentUser')->get()->getRole() === RoleHelper::COORDINATOR) {
            return $this->redirectToRoute('zones');
        }

        if ($this->get('CurrentUser')->get()->getRole() === RoleHelper::CHIEF_TEAM) {
            $teamChief = $this->get('TeamHasChiefRepository')->findBy(['people_id' => $this->get('Currentuser')->get()->getId()]);
            $team = $this->get('TeamRepository')->findById($teamChief[0]->getTeamId());
            return $this->redirectToRoute('zone', ['zone' => $team[0]->getZoneId()]);
        }

        if ($this->get('CurrentUser')->get()->getRole() === RoleHelper::CHIEF_POLE) {
            $poleChief = $this->get('PoleHasChiefRepository')->findBy(['people_id' => $this->get('Currentuser')->get()->getId()]);
            $pole = $this->get('PoleRepository')->findById($poleChief[0]->getPoleId());
            return $this->redirectToRoute('team', ['team' => $pole[0]->getTeamId()]);
        }

        if ($this->get('CurrentUser')->get()->getRole() === RoleHelper::CHIEF_SUBTEAM) {
            $subteamChief = $this->get('SubteamHasChiefRepository')->findBy(['people_id' => $this->get('Currentuser')->get()->getId()]);
            $subteam = $this->get('SubteamRepository')->findById($subteamChief[0]->getSubteamId());
            return $this->redirectToRoute('pole', ['pole' => $subteam[0]->getPoleId()]);
        }

        return $this->redirectToRoute('error');
    }

    /**
     * @Route("/error", name="error")
     * @Method({ "GET" })
     */
    public function error()
    {
        return $this->render('@EventBundle/error.html.twig');
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

        if (
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::VOLONTARIA &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::COORDINATOR
        ) {
            return $this->redirectToRoute('dashboard');
        }

        // Only display zones where the current user is the chief if he is zone chief
        if ($this->get('CurrentUser')->get()->getRole() === RoleHelper::COORDINATOR) {
            $ids = $this->get('ZoneHasChiefRepository')->findBy(['people_id' => $this->get('CurrentUser')->get()->getId()]);
            $ids = array_reduce($ids, function ($previous, $zone) {
                $previous[] = $zone->getZoneId();
                return $previous;
            }, []);
            $zones = $this->get('ZoneRepository')->findBy(['id' => $ids]);
        } else {
            $zones = $this->get('zoneRepository')->findAll();
        }

        return $this->render('@EventBundle/zones.html.twig', [
            'zones' => $zones,
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

        if (
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::VOLONTARIA &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::COORDINATOR &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_TEAM

        ) {
            return $this->redirectToRoute('dashboard');
        }

        // Only display teams where the current user is the chief if he is team chief
        if ($this->get('CurrentUser')->get()->getRole() === RoleHelper::CHIEF_TEAM) {
            $ids = $this->get('TeamHasChiefRepository')->findBy(['people_id' => $this->get('CurrentUser')->get()->getId()]);
            $ids = array_reduce($ids, function ($previous, $team) {
                $previous[] = $team->getTeamId();
                return $previous;
            }, []);
            $teams = $this->get('TeamRepository')->findBy(['id' => $ids]);
        } else {
            $teams = $this->get('TeamRepository')->findBy(['zone_id' => $zone]);
        }

        return $this->render('@EventBundle/teams.html.twig', [
            'zoneId' => $zone,
            'teams'  => $teams,
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

        if (
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::VOLONTARIA &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::COORDINATOR &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_TEAM &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_POLE

        ) {
            return $this->redirectToRoute('dashboard');
        }

        // Only display poles where the current user is the chief if he is pole chief
        if ($this->get('CurrentUser')->get()->getRole() === RoleHelper::CHIEF_POLE) {
            $ids = $this->get('PoleHasChiefRepository')->findBy(['people_id' => $this->get('CurrentUser')->get()->getId()]);
            $ids = array_reduce($ids, function ($previous, $pole) {
                $previous[] = $pole->getPoleId();
                return $previous;
            }, []);
            $poles = $this->get('PoleRepository')->findBy(['id' => $ids]);
        } else {
            $poles = $this->get('PoleRepository')->findBy(['team_id' => $team]);
        }

        return $this->render('@EventBundle/poles.html.twig', [
            'teamId' => $team,
            'poles'  => $poles,
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

        if (
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::VOLONTARIA &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::COORDINATOR &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_TEAM &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_POLE &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_SUBTEAM

        ) {
            return $this->redirectToRoute('dashboard');
        }

        // Only display subteams where the current user is the chief if he is subteam chief
        if ($this->get('CurrentUser')->get()->getRole() === RoleHelper::CHIEF_SUBTEAM) {
            $ids = $this->get('SubteamHasChiefRepository')->findBy(['people_id' => $this->get('CurrentUser')->get()->getId()]);
            $ids = array_reduce($ids, function ($previous, $subteam) {
                $previous[] = $subteam->getSubteamId();
                return $previous;
            }, []);
            $subteams = $this->get('subteamRepository')->findBy(['id' => $ids]);
        } else {
            $subteams = $this->get('subteamRepository')->findBy(['pole_id' => $pole]);
        }

        return $this->render('@EventBundle/subteams.html.twig', [
            'poleId'    => $pole,
            'subteams'  => $subteams,
        ]);
    }

    /**
     * @Route("/trombinoscope/{pole}", name="pole_trombinoscope",requirements={"pole": "\d+"})
     * @Method({ "GET" })
     */
    public function trombinoscopeAction(Request $request, $pole){
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        if (
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::VOLONTARIA &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::COORDINATOR &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_TEAM &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_POLE &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_SUBTEAM

        ) {
            return $this->redirectToRoute('dashboard');
        }

        // Only display subteams where the current user is the chief if he is subteam chief
        if ($this->get('CurrentUser')->get()->getRole() === RoleHelper::CHIEF_SUBTEAM) {
            $ids = $this->get('SubteamHasChiefRepository')->findBy(['people_id' => $this->get('CurrentUser')->get()->getId()]);
            $ids = array_reduce($ids, function ($previous, $subteam) {
                $previous[] = $subteam->getSubteamId();
                return $previous;
            }, []);
            $subteams = $this->get('subteamRepository')->findBy(['id' => $ids]);
        } else {
            $subteams = $this->get('subteamRepository')->findBy(['pole_id' => $pole]);
        }

        return $this->render('@EventBundle/trombinoscope.html.twig', [
            'poleId'    => $pole,
            'subteams'  => $subteams,
        ]);
    }

    /**
     * @Route("/pole/create/{team}", name="pole_create", requirements={"team": "\d+"})
     * @Method({ "GET" })
     */
    public function createPoleAction($team)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        if (
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::VOLONTARIA &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::COORDINATOR &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_TEAM

        ) {
            return $this->redirectToRoute('dashboard');
        }

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

        if (
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::VOLONTARIA &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::COORDINATOR &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_TEAM &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_POLE

        ) {
            return $this->redirectToRoute('dashboard');
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

        if (
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::VOLONTARIA &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_TEAM &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_POLE

        ) {
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('@EventBundle/subteam.edit.html.twig', [
            'teamId'        => $team,
            'displayPoles'  => true,
        ]);
    }

    /**
     * @Route("/pole/edit/{pole}", name="pole_edit")
     * @Method({ "GET" })
     */
    public function editPoleSubteamAction(Request $request, $pole)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        if (
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::VOLONTARIA &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_TEAM &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_POLE &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_SUBTEAM

        ) {
            return $this->redirectToRoute('dashboard');
        }

        $pole = $this->get('PoleRepository')->findBy(['id' => $pole]);
        return $this->render('@EventBundle/subteam.edit.html.twig', [
            'teamId'        => $pole[0]->getTeamId(),
            'displayPoles'  => false,
        ]);
    }

    /**
     * @Route("/api/team/{team}/people/available", name="api_team_available_people")
     * @Method({ "GET" })
     */
    public function apiTeamPeopleAction(Request $request, $team)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        $people = $this->get('PeopleRepository')->getFromTeamIdAndNotSubteam($team);
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

        // Only display subteams where the current user is the chief if he is subteam chief
        if ($this->get('CurrentUser')->get()->getRole() === RoleHelper::CHIEF_SUBTEAM) {
            $ids = $this->get('SubteamHasChiefRepository')->findBy(['people_id' => $this->get('CurrentUser')->get()->getId()]);
            $ids = array_reduce($ids, function ($previous, $subteam) {
                $previous[] = $subteam->getSubteamId();
                return $previous;
            }, []);
            $subteams = $this->get('subteamRepository')->findBy(['id' => $ids]);
        } else {
            $subteams = $this->get('SubteamRepository')->findBy(['pole_id' => $pole]);
        }

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

        if (
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::VOLONTARIA &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_TEAM &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_POLE &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_SUBTEAM

        ) {
            return $this->redirectToRoute('dashboard');
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

    /**
     * @Route("/api/subteam/{subteamId}/people/{peopleId}", name="api_subteam_people_adjoint")
     * @Method({ "PATCH" })
     */
    public function apiSubteamAdjointAction(Request $request, $subteamId, $peopleId)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        if (
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::VOLONTARIA &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_TEAM &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_POLE &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_SUBTEAM

        ) {
            return $this->redirectToRoute('dashboard');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $people = $this->get('PeopleRepository')->findBy(['id' => $peopleId]);
        $subteam = $this->get('SubteamRepository')->findBy(['id' => $subteamId]);
        $isAdjoint = $this->get('SubteamHasAdjointRepository')->findBy(['subteam_id' => $subteamId, 'people_id' => $peopleId]);

        if (empty($people) || empty($subteam)) {
            return new JsonResponse(['error' => true]);
        }

        if (!empty($isAdjoint)) {
            $query = $em->createQuery("DELETE EventBundle:SubteamHasAdjoint sha WHERE sha.subteam_id = :subteam AND sha.people_id = :people ")
                ->setParameter('subteam', $subteamId)
                ->setParameter('people', $peopleId);
            $query->execute();
        } else {
            $newAdjoint = new SubteamHasAdjoint();
            $newAdjoint->setPeopleId($peopleId);
            $newAdjoint->setPeople($people[0]);
            $newAdjoint->setSubteamId($subteamId);
            $newAdjoint->setSubteam($subteam[0]);

            $em->persist($newAdjoint);
            $em->flush();
        }

        return new JsonResponse(['error' => false]);
    }

    /**
     * @Route("/api/subteam/{subteamId}/people/{peopleId}", name="api_subteam_people_delete")
     * @Method({ "DELETE" })
     */
    public function apiSubteamDeleteAction(Request $request, $subteamId, $peopleId)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        if (
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::VOLONTARIA &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_TEAM &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_POLE &&
            $this->get('CurrentUser')->get()->getRole() !== RoleHelper::CHIEF_SUBTEAM

        ) {
            return $this->redirectToRoute('dashboard');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $people = $this->get('PeopleRepository')->findBy(['id' => $peopleId]);
        $subteam = $this->get('SubteamRepository')->findBy(['id' => $subteamId]);

        if (empty($people) || empty($subteam)) {
            return new JsonResponse(['error' => true]);
        }

        $people[0]->setSubteam(null);
        $query = $em->createQuery("DELETE EventBundle:SubteamHasAdjoint sha WHERE sha.subteam_id = :subteam AND sha.people_id = :people ")
            ->setParameter('subteam', $subteamId)
            ->setParameter('people', $peopleId);
        $query->execute();

        $em->persist($people[0]);
        $em->flush();

        return new JsonResponse(['error' => false]);
    }
}
