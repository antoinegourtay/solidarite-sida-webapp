<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Equipe;
use AppBundle\Entity\Pole;
use AppBundle\Entity\Zone;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class VolontariatController extends Controller
{
    /**
     * @Route("volontariat", name="volontariat")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Volontariat:index.html.twig', array(
            // ...
        ));
    }

    /**
     * Finds and displays all the zones of the event
     * @Route("volontariat/zones", name="volontariat_zones")
     */
    public function zoneAction(Zone $zone)
    {
        return $this->render('AppBundle:Volontariat:zones.html.twig', array(

        ));
    }

    /**
     * Finds and displays all the poles in a specific zone
     * @Route("volontariat/zones/{id}", name="volontariat_zone_team")
     *
     */
    public function coordinatorAction(Pole $pole)
    {
        return $this->render('AppBundle:Volontariat:coordinators.html.twig', array(

        ));
    }

    /**
     * @Route("volontariat/)
     */
    public function teamsAction(Equipe $equipe)
    {

        return $this->render('AppBundle:Volontariat:teams.html.twig', array(

        ));
    }
}
