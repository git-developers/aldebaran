<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permission
 *
 * @ORM\Table(name="permission")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\PermissionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Permission
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="group_permission", type="string", length=45, nullable=true)
     */
    private $groupPermission;

    /**
     * @var string
     *
     * @ORM\Column(name="group_permission_tag", type="string", length=45, nullable=true)
     */
    private $groupPermissionTag;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=45, nullable=true)
     */
    private $alias;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status = '1';

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MainBundle\Entity\Profile", mappedBy="permission")
     */
    private $profile;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->profile = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return sprintf('%s - %s', $this->idIncrement, $this->name);
    }

    /**
     * Get idIncrement
     *
     * @return integer
     */
    public function getIdIncrement()
    {
        return $this->idIncrement;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Permission
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set groupPermission
     *
     * @param string $groupPermission
     *
     * @return Permission
     */
    public function setGroupPermission($groupPermission)
    {
        $this->groupPermission = $groupPermission;

        return $this;
    }

    /**
     * Get groupPermission
     *
     * @return string
     */
    public function getGroupPermission()
    {
        return $this->groupPermission;
    }

    /**
     * Set groupPermissionTag
     *
     * @param string $groupPermissionTag
     *
     * @return Permission
     */
    public function setGroupPermissionTag($groupPermissionTag)
    {
        $this->groupPermissionTag = $groupPermissionTag;

        return $this;
    }

    /**
     * Get groupPermissionTag
     *
     * @return string
     */
    public function getGroupPermissionTag()
    {
        return $this->groupPermissionTag;
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Permission
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Permission
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Permission
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Permission
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add profile
     *
     * @param \MainBundle\Entity\Profile $profile
     *
     * @return Permission
     */
    public function addProfile(\MainBundle\Entity\Profile $profile)
    {
        $this->profile[] = $profile;

        return $this;
    }

    /**
     * Remove profile
     *
     * @param \MainBundle\Entity\Profile $profile
     */
    public function removeProfile(\MainBundle\Entity\Profile $profile)
    {
        $this->profile->removeElement($profile);
    }

    /**
     * Get profile
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
