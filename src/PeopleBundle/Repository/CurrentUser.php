<?php
namespace PeopleBundle\Repository;

use PeopleBundle\Entity\People;
use PeopleBundle\Helper\RoleHelper;

class CurrentUser
{
    /** @var People */
    private $user = null;

    private $zoneHasChiefRepository;
    private $poleHasChiefRepository;

    public function __construct($zoneHasChiefRepository, $poleHasChiefRepository)
    {
        $this->zoneHasChiefRepository = $zoneHasChiefRepository;
        $this->poleHasChiefRepository = $poleHasChiefRepository;
    }

    /**
     * @return People
     */
    public function get()
    {
        return $this->user;
    }

    /**
     * @param People $people
     */
    public function set(People $people)
    {
        if ($people->isAdmin() === true) {
            $people->setRole(RoleHelper::VOLONTARIA);
        } else if ( !empty($this->zoneHasChiefRepository->findBy(['people_id' => $people->getId()])) ) {
            $people->setRole(RoleHelper::COORDINATOR);
        } else if ($this->isChief($people->getTeam(), $people)) {
            $people->setRole(RoleHelper::CHIEF_TEAM);
        } else if ( !empty($this->poleHasChiefRepository->findBy(['people_id' => $people->getId()])) ) {
            $people->setRole(RoleHelper::CHIEF_POLE);
        } else if ($this->isChief($people->getSubteam(), $people)) {
            $people->setRole(RoleHelper::CHIEF_SUBTEAM);
        }

        $this->user = $people;
    }

    private function isChief($chiefs, $people)
    {
        if (!$chiefs) {
            return false;
        }

        foreach ($chiefs->getChiefs() as $chief) {
            if ($chief->getPeople()->getId() === $people->getId()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        return $this->user instanceof People;
    }
}
