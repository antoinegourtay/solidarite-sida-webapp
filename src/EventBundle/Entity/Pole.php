<?php
namespace EventBundle\Entity;

use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="poles")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\PoleRepository")
 */
class Pole
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
    private $team_id;

    /**
     * @var Team
     * @ORM\ManyToOne(targetEntity="EventBundle\Entity\Team")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
     */
    private $team;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="EventBundle\Entity\PoleHasChief", mappedBy="pole", fetch="EAGER")
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
    public function getTeamId()
    {
        return $this->team_id;
    }

    /**
     * @param int $team_id
     */
    public function setTeamId($team_id)
    {
        $this->team_id = $team_id;
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
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @param Team $team
     */
    public function setTeam($team)
    {
        $this->team = $team;
    }
}
