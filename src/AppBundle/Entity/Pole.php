<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pole
 *
 * @ORM\Table(name="pole")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PoleRepository")
 */
class Pole
{
    /**
     * @var int
     *
     * @ORM\Column(name="pole_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPole;

    /**
     * @var string
     *
     * @ORM\Column(name="pole_intitule", type="string", length=255)
     */
    private $poleIntitule;

    /**
     * @var int
     *
     * @ORM\Column(name="zone_id", type="integer")
     */
    private $zoneId;

    /**
     * @return int
     */
    public function getIdPole()
    {
        return $this->idPole;
    }

    /**
     * @param int $idPole
     */
    public function setIdPole($idPole)
    {
        $this->idPole = $idPole;
    }

    /**
     * @return string
     */
    public function getPoleIntitule()
    {
        return $this->poleIntitule;
    }

    /**
     * @param string $poleIntitule
     */
    public function setPoleIntitule($poleIntitule)
    {
        $this->poleIntitule = $poleIntitule;
    }

    /**
     * @return int
     */
    public function getZoneId()
    {
        return $this->zoneId;
    }

    /**
     * @param int $zoneId
     */
    public function setZoneId($zoneId)
    {
        $this->zoneId = $zoneId;
    }

}
