<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Equipe
 *
 * @ORM\Table(name="equipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EquipeRepository")
 */
class Equipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="equipe_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idEquipe;

    /**
     * @var string
     *
     * @ORM\Column(name="equipe_nom", type="string", length=255)
     */
    private $equipeNom;

    /**
     * @var int
     *
     * @ORM\Column(name="zone_id", type="integer")
     */
    private $zoneId;

    /**
     * @return int
     */
    public function getIdEquipe()
    {
        return $this->idEquipe;
    }

    /**
     * @param int $idEquipe
     */
    public function setIdEquipe($idEquipe)
    {
        $this->idEquipe = $idEquipe;
    }

    /**
     * @return string
     */
    public function getEquipeNom()
    {
        return $this->equipeNom;
    }

    /**
     * @param string $equipeNom
     */
    public function setEquipeNom($equipeNom)
    {
        $this->equipeNom = $equipeNom;
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
