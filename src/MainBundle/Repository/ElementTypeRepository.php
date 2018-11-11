<?php

namespace MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ElementTypeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ElementTypeRepository extends EntityRepository
{

    public function findAll()
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT elementType
            FROM MainBundle:ElementType elementType
            WHERE
            elementType.status = :status
            ORDER BY elementType.idIncrement ASC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);

        return $query->getResult();
    }

    public function findAllByGroup($groups)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT elementType, groups
            FROM MainBundle:ElementType elementType
            INNER JOIN elementType.group groups
            WHERE
            elementType.status = :status AND
            groups.idIncrement IN (:groups)
            ORDER BY elementType.group ASC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);
        $query->setParameter('groups', $groups);

        return $query->getResult();
    }

    public function findOneById($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT elementType
            FROM MainBundle:ElementType elementType
            WHERE
            elementType.idIncrement = :id AND
            elementType.status = :status
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findOneByType($elementType)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT elementType
            FROM MainBundle:ElementType elementType
            WHERE
            elementType.status = :status AND
            elementType.type = :elementType
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);
        $query->setParameter('elementType', $elementType);

        return $query->getOneOrNullResult();
    }


}