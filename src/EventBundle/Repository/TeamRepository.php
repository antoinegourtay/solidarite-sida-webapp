<?php
namespace EventBundle\Repository;

use Doctrine\ORM\EntityRepository;
use EventBundle\Entity\Team;

class TeamRepository extends EntityRepository
{
    /**
     * @param string $name
     * @param int $zone
     * @return null|Team
     */
    public function getFromNameAndZone($name, $zone)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT t FROM EventBundle:Team t WHERE t.name = :name AND t.zone_id = :zone")
            ->setParameter('name', $name)
            ->setParameter('zone', $zone);
        return $query->getResult();
    }
}
