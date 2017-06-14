<?php
namespace PeopleBundle\Repository;

use PeopleBundle\Entity\People;

class CurrentUser
{
    /** @var People */
    private $user = null;

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
        $this->user = $people;
    }

    /**
     * @return bool
     */
    public function isAuthenticated()
    {
        return $this->user instanceof People;
    }
}
