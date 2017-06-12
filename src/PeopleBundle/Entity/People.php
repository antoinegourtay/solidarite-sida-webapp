<?php
namespace PeopleBundle\Entity;

use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="people")
 * @ORM\Entity(repositoryClass="PeopleBundle\Repository\PeopleRepository")
 */
class People
{
    /**
     * @ORM\Id
     * @GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $first_name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @var int
     * @ORM\Column(type="integer", length=20)
     */
    private $birthdate;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $driver_license;

    /**
     * @var string
     * @ORM\Column(type="string", length=10)
     */
    private $phone;

    /**
     * @var int
     * @ORM\Column(type="integer", length=5)
     */
    private $zipcode;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @var int
     * @ORM\Column(type="integer", length=1)
     */
    private $role;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return int
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @param int $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function hasDriverLicense()
    {
        return $this->driver_license;
    }

    /**
     * @param bool $driver_license
     */
    public function setDriverLicense($driver_license)
    {
        $this->driver_license = $driver_license;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return int
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param int $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param int $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
}
