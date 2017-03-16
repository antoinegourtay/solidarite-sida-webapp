<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping\GeneratedValue;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @GeneratedValue
     */
    protected $idAiw;

    /**
     * @var boolean
     *
     * @ORM\Column(name="driver_licence", type="boolean")
     */
    private $driverLicence;

    /**
     * @return bool
     */
    public function isDriverLicence()
    {
        return $this->driverLicence;
    }

    /**
     * @param bool $driverLicence
     */
    public function setDriverLicence($driverLicence)
    {
        $this->driverLicence = $driverLicence;
    }

    /**
     * @return mixed
     */
    public function getIdAiw()
    {
        return $this->idAiw;
    }

    /**
     * @param mixed $idAiw
     */
    public function setIdAiw($idAiw)
    {
        $this->idAiw = $idAiw;
    }
}