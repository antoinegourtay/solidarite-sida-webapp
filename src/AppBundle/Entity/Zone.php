<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zone
 *
 * @ORM\Table(name="zone")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ZoneRepository")
 */
class Zone
{
    /**
     * @var int
     *
     * @ORM\Column(name="zone_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idZone;

    /**
     * @var string
     *
     * @ORM\Column(name="zone_intitule", type="string", length=255)
     */
    private $zoneIntitule;

    /**
     * @return int
     */
    public function getIdZone()
    {
        return $this->idZone;
    }

    /**
     * @param int $idZone
     */
    public function setIdZone($idZone)
    {
        $this->idZone = $idZone;
    }

    /**
     * @return string
     */
    public function getZoneIntitule()
    {
        return $this->zoneIntitule;
    }

    /**
     * @param string $zoneIntitule
     */
    public function setZoneIntitule($zoneIntitule)
    {
        $this->zoneIntitule = $zoneIntitule;
    }
    
}
