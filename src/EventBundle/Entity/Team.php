<?php
namespace EventBundle\Entity;

use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="teams")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id
     * @GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="integer", length=11)
     */
    private $zone_id;

    /**
     * @var Zone
     * @ORM\ManyToOne(targetEntity="EventBundle\Entity\Zone")
     * @ORM\JoinColumn(name="zone_id", referencedColumnName="id")
     */
    private $zone;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="EventBundle\Entity\TeamHasChief", mappedBy="team", fetch="EAGER")
     */
    private $chiefs;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getZoneId()
    {
        return $this->zone_id;
    }

    /**
     * @param int $zone_id
     */
    public function setZoneId($zone_id)
    {
        $this->zone_id = $zone_id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getChiefs()
    {
        return $this->chiefs;
    }

    /**
     * @param mixed $chiefs
     */
    public function setChiefs($chiefs)
    {
        $this->chiefs = $chiefs;
    }

    /**
     * @return Zone
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * @param Zone $zone
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
    }
}
