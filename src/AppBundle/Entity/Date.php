<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Date
 *
 * @ORM\Table(name="date")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DateRepository")
 */
class Date
{
    /**
     * @var int
     *
     * @ORM\Column(name="date_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idDate;

    /**
     * @var string
     *
     * @ORM\Column(name="date_annee", type="string", length=4)
     */
    private $dateAnnee;

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
     * @return string
     */
    public function getDateAnnee()
    {
        return $this->dateAnnee;
    }

    /**
     * @param string $dateAnnee
     */
    public function setDateAnnee($dateAnnee)
    {
        $this->dateAnnee = $dateAnnee;
    }


}
