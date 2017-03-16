<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="config")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConfigRepository")
 */
class Config
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_config", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idConfig;

    /**
     * @var string
     *
     * @ORM\Column(name="database_host", type="string", length=255)
     */
    private $databaseHost;

    /**
     * @var string
     *
     * @ORM\Column(name="database_port", type="string", length=255)
     */
    private $databasePort;

    /**
     * @var string
     *
     * @ORM\Column(name="database_name", type="string", length=255)
     */
    private $databaseName;

    /**
     * @var string
     *
     * @ORM\Column(name="database_user", type="string", length=255)
     */
    private $databaseUser;

    /**
     * @var string
     *
     * @ORM\Column(name="database_password", type="string", length=255)
     */
    private $databasePassword;

    /**
     * @return int
     */
    public function getIdConfig()
    {
        return $this->idConfig;
    }

    /**
     * @param int $idConfig
     */
    public function setIdConfig($idConfig)
    {
        $this->idConfig = $idConfig;
    }

    /**
     * @return string
     */
    public function getDatabaseHost()
    {
        return $this->databaseHost;
    }

    /**
     * @param string $databaseHost
     */
    public function setDatabaseHost($databaseHost)
    {
        $this->databaseHost = $databaseHost;
    }

    /**
     * @return string
     */
    public function getDatabasePort()
    {
        return $this->databasePort;
    }

    /**
     * @param string $databasePort
     */
    public function setDatabasePort($databasePort)
    {
        $this->databasePort = $databasePort;
    }

    /**
     * @return string
     */
    public function getDatabaseName()
    {
        return $this->databaseName;
    }

    /**
     * @param string $databaseName
     */
    public function setDatabaseName($databaseName)
    {
        $this->databaseName = $databaseName;
    }

    /**
     * @return string
     */
    public function getDatabaseUser()
    {
        return $this->databaseUser;
    }

    /**
     * @param string $databaseUser
     */
    public function setDatabaseUser($databaseUser)
    {
        $this->databaseUser = $databaseUser;
    }

    /**
     * @return string
     */
    public function getDatabasePassword()
    {
        return $this->databasePassword;
    }

    /**
     * @param string $databasePassword
     */
    public function setDatabasePassword($databasePassword)
    {
        $this->databasePassword = $databasePassword;
    }


}
