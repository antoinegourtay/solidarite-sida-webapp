<?php
namespace EventBundle\Entity;

use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="team_has_chief")
 */
class TeamHasChief
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer", length=11)
     */
    private $team_id;

    /**
     * @ORM\ManyToOne(targetEntity="EventBundle\Entity\Team", inversedBy="chiefs")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $team;

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer", length=11)
     */
    private $people_id;

    /**
     * @ORM\ManyToOne(targetEntity="PeopleBundle\Entity\People")
     * @ORM\JoinColumn(name="people_id", referencedColumnName="id")
     */
    private $people;

    /**
     * @return mixed
     */
    public function getTeamId()
    {
        return $this->team_id;
    }

    /**
     * @param mixed $team_id
     */
    public function setTeamId($team_id)
    {
        $this->team_id = $team_id;
    }

    /**
     * @return int
     */
    public function getPeopleId()
    {
        return $this->people_id;
    }

    /**
     * @param int $people_id
     */
    public function setPeopleId($people_id)
    {
        $this->people_id = $people_id;
    }

    /**
     * @return mixed
     */
    public function getPeople()
    {
        return $this->people;
    }

    /**
     * @return mixed
     */
    public function getTeam()
    {
        return $this->team;
    }
}
