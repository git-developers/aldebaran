<?php

namespace MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * FilesMimeTypeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FilesMimeTypeRepository extends EntityRepository
{

    public function findAll()
    {
        return $this->findBy(array('status' => true), array('idIncrement' => 'DESC'));
    }

    public function findOneByMimeType($mimeType)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT files
            FROM MainBundle:FilesMimeType files
            WHERE
            files.mimeType = :mimeType AND
            files.status = :status
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('mimeType', $mimeType);
        $query->setParameter('status', 1);

        return $query->getOneOrNullResult();
    }


}
