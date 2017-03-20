<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poste
 *
 * @ORM\Table(name="poste")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PosteRepository")
 */
class Type
{
    /**
     * @var int
     *
     * @ORM\Column(name="type_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idType;

    /**
     * @var string
     *
     * @ORM\Column(name="type_intitule", type="string", length=255)
     */
    private $typeIntitule;

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
     * @return string
     */
    public function getTypeIntitule()
    {
        return $this->typeIntitule;
    }

    /**
     * @param string $typeIntitule
     */
    public function setTypeIntitule($typeIntitule)
    {
        $this->typeIntitule = $typeIntitule;
    }




}
