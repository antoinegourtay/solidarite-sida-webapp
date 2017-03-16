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
     * @ORM\Column(name="equipe_zone", type="string", length=255)
     */
    private $equipeZone;

    /**
     * @var string
     *
     * @ORM\Column(name="equipe_equipe_nom", type="string", length=255)
     */
    private $equipeEquipeNom;

    /**
     * @var string
     *
     * @ORM\Column(name="equipe_pole", type="string", length=255)
     */
    private $equipePole;

    /**
     * @var string
     *
     * @ORM\Column(name="equipe_sous_equipe", type="string", length=255)
     */
    private $equipeSousEquipe;

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
    public function getEquipeZone()
    {
        return $this->equipeZone;
    }

    /**
     * @param string $equipeZone
     */
    public function setEquipeZone($equipeZone)
    {
        $this->equipeZone = $equipeZone;
    }

    /**
     * @return string
     */
    public function getEquipeEquipeNom()
    {
        return $this->equipeEquipeNom;
    }

    /**
     * @param string $equipeEquipeNom
     */
    public function setEquipeEquipeNom($equipeEquipeNom)
    {
        $this->equipeEquipeNom = $equipeEquipeNom;
    }

    /**
     * @return string
     */
    public function getEquipePole()
    {
        return $this->equipePole;
    }

    /**
     * @param string $equipePole
     */
    public function setEquipePole($equipePole)
    {
        $this->equipePole = $equipePole;
    }

    /**
     * @return string
     */
    public function getEquipeSousEquipe()
    {
        return $this->equipeSousEquipe;
    }

    /**
     * @param string $equipeSousEquipe
     */
    public function setEquipeSousEquipe($equipeSousEquipe)
    {
        $this->equipeSousEquipe = $equipeSousEquipe;
    }


}
