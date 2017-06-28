<?php
namespace EventBundle\Entity;

use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pole_has_chief")
 */
class PoleHasChief
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer", length=11)
     */
    private $pole_id;

    /**
     * @ORM\ManyToOne(targetEntity="EventBundle\Entity\Pole", inversedBy="chiefs")
     * @ORM\JoinColumn(name="pole_id", referencedColumnName="id")
     */
    private $pole;

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
    public function getPoleId()
    {
        return $this->pole_id;
    }

    /**
     * @param mixed $pole_id
     */
    public function setPoleId($pole_id)
    {
        $this->pole_id = $pole_id;
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
    public function getPole()
    {
        return $this->pole;
    }

    /**
     * @param mixed $pole
     */
    public function setPole($pole)
    {
        $this->pole = $pole;
    }

    /**
     * @param mixed $people
     */
    public function setPeople($people)
    {
        $this->people = $people;
    }
}
