<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

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
     *
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
     * @ManyToOne(targetEntity="AppBundle\Entity\Equipe")
     * @JoinColumn(name="equipe_id", referencedColumnName="equipe_id")
     */
    private $equipeId;

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
    public function getEquipeId()
    {
        return $this->equipeId;
    }

    /**
     * @param int $equipeId
     */
    public function setEquipeId($equipeId)
    {
        $this->equipeId = $equipeId;
    }


}
