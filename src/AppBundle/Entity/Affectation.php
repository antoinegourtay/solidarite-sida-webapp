<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affectation
 *
 * @ORM\Table(name="affectation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AffectationRepository")
 */
class Affectation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_affectation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idAffectation;

    /**
     * @var int
     *
     * @ORM\Column(name="id_equipe", type="integer")
     */
    private $idEquipe;

    /**
     * @var int
     *
     * @ORM\Column(name="id_date", type="integer")
     */
    private $idDate;

    /**
     * @var int
     *
     * @ORM\Column(name="id_evenement", type="integer")
     */
    private $idEvenement;

    /**
     * @var int
     *
     * @ORM\Column(name="id_poste", type="integer")
     */
    private $idPoste;

    /**
     * @var int
     *
     * @ORM\Column(name="id_benevole", type="integer")
     */
    private $idBenevole;

    /**
     * @var boolean
     *
     * @ORM\Column(name="affectation_adjoint", type="boolean")
     */
    private $affectationAdjoint;

    /**
     * @return int
     */
    public function getIdAffectation()
    {
        return $this->idAffectation;
    }

    /**
     * @param int $idAffectation
     */
    public function setIdAffectation($idAffectation)
    {
        $this->idAffectation = $idAffectation;
    }

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
     * @return int
     */
    public function getIdDate()
    {
        return $this->idDate;
    }

    /**
     * @param int $idDate
     */
    public function setIdDate($idDate)
    {
        $this->idDate = $idDate;
    }

    /**
     * @return int
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * @param int $idEvenement
     */
    public function setIdEvenement($idEvenement)
    {
        $this->idEvenement = $idEvenement;
    }

    /**
     * @return int
     */
    public function getIdPoste()
    {
        return $this->idPoste;
    }

    /**
     * @param int $idPoste
     */
    public function setIdPoste($idPoste)
    {
        $this->idPoste = $idPoste;
    }

    /**
     * @return int
     */
    public function getIdBenevole()
    {
        return $this->idBenevole;
    }

    /**
     * @param int $idBenevole
     */
    public function setIdBenevole($idBenevole)
    {
        $this->idBenevole = $idBenevole;
    }

    /**
     * @return bool
     */
    public function isAffectationAdjoint()
    {
        return $this->affectationAdjoint;
    }

    /**
     * @param bool $affectationAdjoint
     */
    public function setAffectationAdjoint($affectationAdjoint)
    {
        $this->affectationAdjoint = $affectationAdjoint;
    }




}
