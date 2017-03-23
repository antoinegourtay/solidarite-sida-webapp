<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

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
     * @OneToOne(targetEntity="AppBundle\Entity\SousEquipe")
     * @JoinColumn(name="id_sous_equipe", referencedColumnName="sous_equipe_id")
     */
    private $idSousEquipe;

    /**
     * @var int
     *
     * @OneToOne(targetEntity="AppBundle\Entity\Date")
     * @JoinColumn(name="id_date", referencedColumnName="date_id")
     */
    private $idDate;

    /**
     * @var int
     *
     * @OneToOne(targetEntity="AppBundle\Entity\Evenement")
     * @JoinColumn(name="id_evenement", referencedColumnName="evenement_id")
     */
    private $idEvenement;

    /**
     * @var int
     *
     * @OneToOne(targetEntity="AppBundle\Entity\Type")
     * @JoinColumn(name="id_type", referencedColumnName="type_id")
     */
    private $idType;

    /**
     * @var int
     *
     * @OneToOne(targetEntity="AppBundle\Entity\User")
     * @JoinColumn(name="id_benevole", referencedColumnName="id_benevole")
     */
    private $idBenevole;

    /**
     * @var boolean
     *
     * @ORM\Column(name="affectation_adjoint", type="boolean")
     *
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
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * @param int $idType
     */
    public function setIdType($idType)
    {
        $this->idType = $idType;
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
