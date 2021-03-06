<?php

namespace MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * FilesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FilesRepository extends EntityRepository
{

    public function findAll()
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT files, mimeType
            FROM MainBundle:Files files
            LEFT JOIN files.filesMimeType mimeType
            WHERE
            files.status = :status
            ORDER BY files.idIncrement DESC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);

        return $query->getResult();

    }

    public function findOneById($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT files
            FROM MainBundle:Files files
            WHERE
            files.idIncrement = :id AND
            files.status = :status
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('id', $id);
        $query->setParameter('status', 1);

        return $query->getOneOrNullResult();
    }

    public function findAllByType($mimeType)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT files, mimeType
            FROM MainBundle:Files files
            LEFT JOIN files.filesMimeType mimeType
            WHERE
            mimeType.type IN (:mimeType) AND
            files.status = :status
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('mimeType', $mimeType);
        $query->setParameter('status', 1);

        return $query->getResult();
    }


}
