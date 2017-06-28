<?php

namespace PeopleBundle\Controller;

use EventBundle\Entity\Team;
use EventBundle\Entity\TeamHasChief;
use EventBundle\Entity\Zone;
use EventBundle\Entity\ZoneHasChief;
use PeopleBundle\Entity\People;
use PeopleBundle\Helper\RoleHelper;
use PeopleBundle\Importer\CSVImporter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PeopleController extends Controller
{
    /**
     * @Route("/login", name="account_login")
     * @Method({ "POST" })
     */
    public function loginAction(Request $request)
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        try {
            $user = $this->container->get('AuthenticationService')->login($email, $password);
            $request->getSession()->set('user.email', $user->getEmail());

            return $this->redirectToRoute('dashboard');
        } catch (\InvalidArgumentException $exception) {
            return $this->redirectToRoute('homepage', array('error-message' => 'Les identifiants de connexion sont incorrects'));
        }
    }

    /**
     * @Route("/", name="homepage")
     * @Method({ "GET" })
     */
    public function homepageAction(Request $request)
    {
        if ($this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('@PeopleBundle/homepage.html.twig');
    }

    /**
     * @Route("/import", name="import")
     * @Method({ "GET" })
     */
    public function importAction(Request $request)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        if ($this->get('CurrentUser')->get()->getRole() !== RoleHelper::VOLONTARIA) {
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('@EventBundle/import.html.twig');
    }

    /**
     * @Route("/importing", name="importing")
     * @Method({ "POST" })
     */
    public function importingAction(Request $request)
    {
        if (!$this->get('CurrentUser')->isAuthenticated()) {
            return $this->redirectToRoute('homepage');
        }

        if (!$this->get('CurrentUser')->get()->isAdmin()) {
            return $this->redirectToRoute('dashboard');
        }

        $csvFile = $request->files->get('csvFile');
        $people = CSVImporter::import($csvFile->getRealPath());
        $em = $this->getDoctrine()->getEntityManager();
        $numberOfTeams = 0;
        $numberOfChiefs = 0;
        $numberOfBenevoles = 0;

        foreach ($people as $person) {
            // Check if the zone already exists
            $zoneEntry = $this->get('ZoneRepository')->getFromName($person['zone']);
            if (!$zoneEntry) {
                $newZone = new Zone();
                $newZone->setName($person['zone']);
                $em->persist($newZone);
                $em->flush();
            } else {
                $newZone = $zoneEntry[0];
            }

            // Check if the team already exists
            $teamEntry = $this->get('TeamRepository')->getFromNameAndZone($person['team'], $newZone->getId());
            if (!$teamEntry) {
                $newTeam = new Team();
                $newTeam->setName($person['team']);
                $newTeam->setZone($newZone);
                $em->persist($newTeam);
                $em->flush();
                $numberOfTeams++;
            } else {
                $newTeam = $teamEntry[0];
            }

            // Check if the user already exists
            $databaseEntry = $this->get('PeopleRepository')->getFromEmail($person['email']);
            if (!$databaseEntry) {
                $newPerson = new People();
                $newPerson->setEmail($person['email']);
            } else {
                $newPerson = $databaseEntry;

                // Check if the user is chief of a team
                $chiefOfTeam = $this->get('TeamHasChiefRepository')->findBy(['people_id' => $newPerson->getId(), 'team_id' => $newTeam->getId()]);
                if (!$chiefOfTeam) {
                    // If was not chief and now chief we create bond
                    if ($person['chief'] == "1") {
                        $newChiefOfTeam = new TeamHasChief();
                        $newChiefOfTeam->setPeople($newPerson);
                        $newChiefOfTeam->setPeopleId($newPerson->getId());
                        $newChiefOfTeam->setTeam($newTeam);
                        $newChiefOfTeam->setTeamId($newTeam->getId());
                        $em->persist($newChiefOfTeam);
                        $em->flush();
                        $numberOfChiefs++;
                    }
                } else {
                    // if was chief and not chief anymore we delete bond
                    if ($person['chief'] == "0") {
                        // Team chiefs
                        $qb = $em->createQueryBuilder();
                        $qb->delete('TeamHasChief', 'thc');
                        $qb->where('thc.people_id = :user');
                        $qb->where('thc.team_id = :team');
                        $qb->setParameter('user', $newPerson->getId());
                        $qb->setParameter('team', $newTeam->getId());
                        $qb->execute();

                        // Poles chiefs
                        $poles = $this->get('PoleRepository')->findBy(['team_id' => $newTeam->getId()]);
                        foreach($poles as $pole) {
                            $qb = $em->createQueryBuilder();
                            $qb->delete('PoleHasChief', 'phc');
                            $qb->where('phc.people_id = :user');
                            $qb->where('phc.pole_id = :pole');
                            $qb->setParameter('user', $newPerson->getId());
                            $qb->setParameter('pole', $pole->getId());
                            $qb->execute();
                        }
                    }
                }
            }

            // Check if the user is coordo
            $chiefOfZone = $this->get('ZoneHasChiefRepository')->findBy(['people_id' => $newPerson->getId(), 'zone_id' => $newZone->getId()]);
            if (!$chiefOfZone && $person['coordo'] == "1") {
                $newZoneHasChief = new ZoneHasChief();
                $newZoneHasChief->setPeopleId($newPerson->getId());
                $newZoneHasChief->setPeople($newPerson);
                $newZoneHasChief->setZoneId($newZone->getId());
                $newZoneHasChief->setZone($newZone);
                $em->persist($newZoneHasChief);
                $em->flush();
            }

            if ($person['chief'] == "0") {
                $numberOfBenevoles++;
            }

            // Update user informations
            $newPerson->setFirstName($person['firstName']);
            $newPerson->setLastName($person['lastName']);
            $newPerson->setAddress($person['address']);
            $newPerson->setZipcode($person['zipcode']);
            $newPerson->setCity($person['city']);
            $newPerson->setPhone($person['phone']);
            $newPerson->setDriverLicense($person['driverLicense']);
            $newPerson->setTeam($newTeam);

            // SAVE CHANGES
            $em->persist($newPerson);
            $em->flush();
        }

        return $this->render('@EventBundle/imported.html.twig', [
            'chiefs'    => $numberOfChiefs,
            'benevoles' => $numberOfBenevoles,
            'teams'     => $numberOfTeams
        ]);
    }

    /**
     * @Route("/print", name="print")
     * @Method({ "GET" })
     */
    //TODO: Handle errors with actions @Nico
    public function printAction(Request $request)
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

        $volontaria = $request->query->get('volontaria');
        $type = $request->query->get('type');
        $id = $request->query->get('id');

        if ($volontaria === 'true') {
            $zones = $this->get('zoneRepository')->findAll();

            return $this->render('@EventBundle/print.html.twig', [
                'zones' => $zones,
            ]);
        }

        if ($id && $type == 'zone') {
            $zones = $this->get('ZoneRepository')->findBy(['id' => $id]);

            return $this->render('@EventBundle/print.html.twig', [
                'zones' => $zones,
            ]);
        }

        if ($id && $type == 'team') {
            $teams = $this->get('TeamRepository')->findBy(['id' => $id]);

            return $this->render('@EventBundle/print.html.twig', [
                'zones' => false,
                'teams' => $teams,
            ]);
        }

        if ($id && $type == 'pole') {
            $poles = $this->get('PoleRepository')->findBy(['id' => $id]);

            return $this->render('@EventBundle/print.html.twig', [
                'zones'    => false,
                'teams'    => false,
                'poles'    => $poles,
            ]);
        }

        if ($id && $type == 'subteam') {
            $subteams = $this->get('subteamRepository')->findBy(['id' => $id]);

            return $this->render('@EventBundle/print.html.twig', [
                'zones'    => false,
                'teams'    => false,
                'poles'    => false,
                'subteams' => $subteams,
            ]);
        }

        return $this->render('@EventBundle/print.html.twig', [
            'zones'    => false,
            'teams'    => false,
            'poles'    => false,
            'subteams' => false,
        ]);
    }


    /**
     * @Route("/printtrombi", name="print_trombinoscope_action")
     *
     */
    public function printTrombiAction(Request $request, $informations, $format, $peoplePerLine)
    {
        $pdf = $this->get('knp_snappy.pdf');
        /* Here we will put the options we want */
        $pdf->setOption('page-size', $format);
        /**
         * We retrive the data from the entities we need with doctrine
         */
        $em = $this->getDoctrine()->getRepository('AppBundle:Affectation');
        /**
         * In the array, we put the data we want to pass to the twig template
         */
        $html = $this->renderView('@EventBundle/pdf/trombi.html.twig', array(
            'title' => 'Trombinoscope d\'équipe',
        ));
        $filename = 'Trombinoscope';

        /**
         * The response for the pdf file output
         */
        return new Response(
            $pdf->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'.pdf"',
            )
        );
    }


    /**
     * @Route("/printcallsheet", name="print_trombinoscope_callsheet")
     */
    public function printCallsheetAction(Request $request, $informations, $numberOfColumns)
    {
        $pdf = $this->get('knp_snappy.pdf');
        /* Here we will put the options we want */
        $pdf->setOption('page-size', 'A4');
        /**
         * In the array, we put the data we want to pass to the twig template
         */
        $html = $this->renderView('@EventBundle/pdf/callsheet.html.twig', array(
            'title' => 'Feuille d\'appel'
        ));
        $filename = 'Trombinoscope';
        return new Response(
            $pdf->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }

    /**
     * @Route("logout", name="logout")
     * @return mixed
     */
    public function logout()
    {
        $this->get('security.context')->setToken(null);
        $this->get('request')->getSession()->invalidate();

        return $this->redirectToRoute('homepage');
    }
}
