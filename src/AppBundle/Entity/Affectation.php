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


}
