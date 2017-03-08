<?php

namespace AppBundle\Entity;

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
     */
    protected $idAiw;

    /**
     * @var string
     *
     * @ORM\Column(name="name_user", type="string", length=255)
     */
    private $nameUser;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname_user", type="string", length=255)
     */
    private $firstnameUser;

    /**
     * @ORM\Column(name="birthdate_user", type="datetime")
     */
    private $birthDateUser;

    /**
     * @var string
     *
     * @ORM\Column(name="email_user", type="string", length=255, unique=true)
     */
    private $emailUser;

    /**
     * @var boolean
     *
     * @ORM\Column(name="driver_licence_user", type="boolean")
     */
    private $driverLicence;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number_user", type="string", length=10, unique=true)
     */
    private $phoneNumberUser;

    /**
     * @ORM\Column(name="adress_street_user", type="string", length=255)
     */
    private $adressStreetUser;

    /**
     * @ORM\Column(name="adress_zipcode_user", type="string", length=5)
     */
    private $adressZipcodeUser;

    /**
     * @var string
     *
     * @ORM\Column(name="adress_city_user", type="string", length=255)
     */
    private $adressCityUser;

    /**
     * @return mixed
     */
    public function getBirthDateUser()
    {
        return $this->birthDateUser;
    }

    /**
     * @param mixed $birthDateUser
     */
    public function setBirthDateUser($birthDateUser)
    {
        $this->birthDateUser = $birthDateUser;
    }

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
    public function getAdressStreetUser()
    {
        return $this->adressStreetUser;
    }

    /**
     * @param mixed $adressStreetUser
     */
    public function setAdressStreetUser($adressStreetUser)
    {
        $this->adressStreetUser = $adressStreetUser;
    }

    /**
     * @return mixed
     */
    public function getAdressZipcodeUser()
    {
        return $this->adressZipcodeUser;
    }

    /**
     * @param mixed $adressZipcodeUser
     */
    public function setAdressZipcodeUser($adressZipcodeUser)
    {
        $this->adressZipcodeUser = $adressZipcodeUser;
    }

    /**
     * @return string
     */
    public function getAdressCityUser()
    {
        return $this->adressCityUser;
    }

    /**
     * @param string $adressCityUser
     */
    public function setAdressCityUser($adressCityUser)
    {
        $this->adressCityUser = $adressCityUser;
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

    /**
     * @return string
     */
    public function getNameUser()
    {
        return $this->nameUser;
    }

    /**
     * @param string $nameUser
     */
    public function setNameUser($nameUser)
    {
        $this->nameUser = $nameUser;
    }

    /**
     * @return string
     */
    public function getFirstnameUser()
    {
        return $this->firstnameUser;
    }

    /**
     * @param string $firstnameUser
     */
    public function setFirstnameUser($firstnameUser)
    {
        $this->firstnameUser = $firstnameUser;
    }

    /**
     * @return string
     */
    public function getEmailUser()
    {
        return $this->emailUser;
    }

    /**
     * @param string $emailUser
     */
    public function setEmailUser($emailUser)
    {
        $this->emailUser = $emailUser;
    }

    /**
     * @return string
     */
    public function getPhoneNumberUser()
    {
        return $this->phoneNumberUser;
    }

    /**
     * @param string $phoneNumberUser
     */
    public function setPhoneNumberUser($phoneNumberUser)
    {
        $this->phoneNumberUser = $phoneNumberUser;
    }



}