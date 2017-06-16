<?php
namespace EventBundle\Repository;

use Doctrine\ORM\EntityRepository;
use EventBundle\Entity\Zone;

class ZoneRepository extends EntityRepository
{
    /**
     * @param string $name
     * @return null|Zone
     */
    public function getFromName($name)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT p FROM EventBundle:Zone z WHERE z.name = :name ")
            ->setParameter('name', $name);
        return $query->getFirstResult();
    }
}
