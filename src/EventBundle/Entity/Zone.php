<?php
namespace EventBundle\Entity;

use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="zones")
 * @ORM\Entity(repositoryClass="EventBundle\Repository\ZoneRepository")
 */
class Zone
{
    /**
     * @ORM\Id
     * @GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="EventBundle\Entity\ZoneHasChief", mappedBy="zone", fetch="EAGER")
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
}
