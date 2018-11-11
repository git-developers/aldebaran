<?php

namespace MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProfileRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProfileRepository extends EntityRepository
{

    public function findAll()
    {
        return $this->findBy(array('status' => 1), array('idIncrement' => 'DESC'));
    }

    public function findOneById($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT profile
            FROM MainBundle:Profile profile
            WHERE
            profile.idIncrement = :id AND
            profile.status = :status
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }
}
