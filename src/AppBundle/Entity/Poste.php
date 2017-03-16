<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poste
 *
 * @ORM\Table(name="poste")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PosteRepository")
 */
class Poste
{
    /**
     * @var int
     *
     * @ORM\Column(name="poste_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idPoste;

    /**
     * @var string
     *
     * @ORM\Column(name="poste_intitule", type="string", length=255)
     */
    private $posteIntitule;

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
     * @return string
     */
    public function getPosteIntitule()
    {
        return $this->posteIntitule;
    }

    /**
     * @param string $posteIntitule
     */
    public function setPosteIntitule($posteIntitule)
    {
        $this->posteIntitule = $posteIntitule;
    }


}
