<?php
namespace EventBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SubteamHasAdjointRepository extends EntityRepository
{
    public function removeSubteamAndPeople($subteam, $people)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("DELETE EventBundle:SubteamHasAdjoint sha WHERE sha.subteam_id = :subteam AND sha.people_id = :people ")
            ->setParameter('subteam', $subteam)
            ->setParameter('people', $people);
        return $query->execute();
    }
}
