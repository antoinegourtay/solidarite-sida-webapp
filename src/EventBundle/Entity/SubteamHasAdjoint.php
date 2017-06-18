<?php
namespace EventBundle\Entity;

use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subteam_has_adjoint")
 */
class SubteamHasAdjoint
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer", length=11)
     */
    private $subteam_id;

    /**
     * @ORM\ManyToOne(targetEntity="EventBundle\Entity\Subteam", inversedBy="chiefs")
     * @ORM\JoinColumn(name="subteam_id", referencedColumnName="id")
     */
    private $subteam;

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
    public function getSubteamId()
    {
        return $this->subteam_id;
    }

    /**
     * @param mixed $subteam_id
     */
    public function setSubteamId($subteam_id)
    {
        $this->subteam_id = $subteam_id;
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
     * @param mixed $people
     */
    public function setPeople($people)
    {
        $this->people = $people;
    }

    /**
     * @return mixed
     */
    public function getSubteam()
    {
        return $this->subteam;
    }

    /**
     * @param mixed $subteam
     */
    public function setSubteam($subteam)
    {
        $this->subteam = $subteam;
    }
}
