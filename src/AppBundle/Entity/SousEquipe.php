<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * SousEquipe
 *
 * @ORM\Table(name="sous_equipe")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SousEquipeRepository")
 */
class SousEquipe
{
    /**
     * @var int
     *
     * @ORM\Column(name="sous_equipe_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idSousEquipe;

    /**
     * @var string
     *
     * @ORM\Column(name="sous_equipe_intule", type="string", length=255)
     */
    private $intituleSousEquipe;

    /**
     * @var int
     **
     * @ManyToOne(targetEntity="AppBundle\Entity\Pole")
     * @JoinColumn(name="pole_id", referencedColumnName="pole_id")
     */
    private $poleId;

    /**
     * @return int
     */
    public function getIdSousEquipe()
    {
        return $this->idSousEquipe;
    }

    /**
     * @param int $idSousEquipe
     */
    public function setIdSousEquipe($idSousEquipe)
    {
        $this->idSousEquipe = $idSousEquipe;
    }

    /**
     * @return string
     */
    public function getIntituleSousEquipe()
    {
        return $this->intituleSousEquipe;
    }

    /**
     * @param string $intituleSousEquipe
     */
    public function setIntituleSousEquipe($intituleSousEquipe)
    {
        $this->intituleSousEquipe = $intituleSousEquipe;
    }

    /**
     * @return int
     */
    public function getPoleId()
    {
        return $this->poleId;
    }

    /**
     * @param int $poleId
     */
    public function setPoleId($poleId)
    {
        $this->poleId = $poleId;
    }


}
