<?php

namespace MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{

    public function findAll()
    {
        return $this->findBy(array('status' => true), array('idIncrement' => 'DESC'));
    }

    public function findOneByDniEmail($dni, $email)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user
            FROM MainBundle:User user
            WHERE
            user.status = :status AND
            (user.dni = :dni OR user.email = :email)
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('dni', $dni);
        $query->setParameter('email', $email);
        $query->setParameter('status', 1);

        return $query->getOneOrNullResult();
    }

    public function findOneByDniEmail2($dni, $email)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user
            FROM MainBundle:User user
            WHERE
            user.dni = :dni OR user.email = :email
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('dni', $dni);
        $query->setParameter('email', $email);

        return $query->getOneOrNullResult();
    }

    public function login($dni, $password)
    {

        $em = $this->getEntityManager();
        $dql = "
            SELECT user
            FROM MainBundle:User user
            WHERE
            user.status = :status AND
            user.password = :password AND
            user.dni = :dni
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('dni', $dni);
        $query->setParameter('password', $password);
        $query->setParameter('status', 1);

        return $query->getOneOrNullResult();
    }

    public function findOneById($id)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user
            FROM MainBundle:User user
            WHERE
            user.idIncrement = :id AND
            user.status = :status
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);
        $query->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

    public function findOneByProfile($id, $profile)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user, profile
            FROM MainBundle:User user
            INNER JOIN user.profile profile
            WHERE
            user.idIncrement= :id AND
            profile.name = :profile AND
            user.status = :status
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);
        $query->setParameter('id', $id);
        $query->setParameter('profile', $profile);

        return $query->getOneOrNullResult();
    }

    public function findAllByProfile($profile)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user, profile
            FROM MainBundle:User user
            INNER JOIN user.profile profile
            INNER JOIN profile.permission permission
            WHERE
            permission.alias = :profile AND
            user.status = :status
            ORDER BY user.idIncrement DESC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);
        $query->setParameter('profile', $profile);

        return $query->getResult();
    }

    public function findAllByRole($role)
    {
        $em = $this->getEntityManager();
        $dql = "
            SELECT user, profile
            FROM MainBundle:User user
            INNER JOIN user.profile profile
            INNER JOIN profile.permission permission
            WHERE
            permission.groupPermission = :role AND
            user.status = :status
            ORDER BY user.idIncrement DESC
            ";

        $query = $em->createQuery($dql);
        $query->setParameter('status', 1);
        $query->setParameter('role', str_replace('ROLE_','',$role));

        return $query->getResult();
    }



}
