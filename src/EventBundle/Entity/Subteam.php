<?php
namespace EventBundle\Entity;

use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subteams")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\SubteamRepository")
 */
class Subteam
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
    private $pole_id;

    /**
     * @var Pole
     * @ORM\ManyToOne(targetEntity="EventBundle\Entity\Pole")
     * @ORM\JoinColumn(name="pole_id", referencedColumnName="id")
     */
    private $pole;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="EventBundle\Entity\SubteamHasChief", mappedBy="subteam", fetch="EAGER")
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
    public function getPoleId()
    {
        return $this->pole_id;
    }

    /**
     * @param int $pole_id
     */
    public function setPoleId($pole_id)
    {
        $this->pole_id = $pole_id;
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
     * @return Pole
     */
    public function getPole()
    {
        return $this->pole;
    }

    /**
     * @param Pole $pole
     */
    public function setTeam($pole)
    {
        $this->pole = $pole;
    }
}
