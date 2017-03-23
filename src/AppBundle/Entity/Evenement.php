<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="evenement_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idEvenement;

    /**
     * @var string
     *
     * @ORM\Column(name="evenement_nom", type="string", length=255)
     */
    private $evenementNom;

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
     * @return string
     */
    public function getEvenementNom()
    {
        return $this->evenementNom;
    }

    /**
     * @param string $evenementNom
     */
    public function setEvenementNom($evenementNom)
    {
        $this->evenementNom = $evenementNom;
    }



}
