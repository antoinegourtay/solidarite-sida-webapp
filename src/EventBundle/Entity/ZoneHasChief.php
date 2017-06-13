<?php
namespace EventBundle\Entity;

use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="zone_has_chief")
 */
class ZoneHasChief
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer", length=11)
     */
    private $zone_id;

    /**
     * @ORM\ManyToOne(targetEntity="EventBundle\Entity\Zone", inversedBy="chiefs")
     * @ORM\JoinColumn(name="zone_id", referencedColumnName="id")
     */
    private $zone;

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
    public function getZoneId()
    {
        return $this->zone_id;
    }

    /**
     * @param mixed $zone_id
     */
    public function setZoneId($zone_id)
    {
        $this->zone_id = $zone_id;
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
    public function getZone()
    {
        return $this->zone;
    }
}
