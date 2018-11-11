<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ElementType
 *
 * @ORM\Table(name="element_type", indexes={@ORM\Index(name="fk_element_group1_idx", columns={"group_id"})})
 * @ORM\Entity(repositoryClass="MainBundle\Repository\ElementTypeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class ElementType
{
    const GROUP_FORM = 1;
    const GROUP_KITCHEN = 2;
    const GROUP_CHAIRS = 3;
    const GROUP_CATERING = 4;
    const GROUP_GLASES = 5;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="name_es", type="string", length=120, nullable=true)
     */
    private $nameEs;

    /**
     * @var string
     *
     * @ORM\Column(name="name_en", type="string", length=120, nullable=true)
     */
    private $nameEn;

    /**
     * @var string
     *
     * @ORM\Column(name="icon", type="string", length=100, nullable=true)
     */
    private $icon;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

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
     * @var \MainBundle\Entity\ElementGroup
     *
     * @ORM\OneToOne(targetEntity="MainBundle\Entity\ElementGroup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group_id", referencedColumnName="id_increment", unique=true)
     * })
     */
    private $group;



    /**
     * Set idIncrement
     *
     * @param integer $idIncrement
     *
     * @return ElementType
     */
    public function setIdIncrement($idIncrement)
    {
        $this->idIncrement = $idIncrement;

        return $this;
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
     * Set type
     *
     * @param string $type
     *
     * @return ElementType
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Set nameEs
     *
     * @param string $nameEs
     *
     * @return ElementType
     */
    public function setNameEs($nameEs)
    {
        $this->nameEs = $nameEs;

        return $this;
    }

    /**
     * Get nameEs
     *
     * @return string
     */
    public function getNameEs()
    {
        return $this->nameEs;
    }

    /**
     * Set nameEn
     *
     * @param string $nameEn
     *
     * @return ElementType
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    /**
     * Get nameEn
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * Set icon
     *
     * @param string $icon
     *
     * @return ElementType
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return ElementType
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
     * @return ElementType
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
     * @return ElementType
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
     * Set group
     *
     * @param \MainBundle\Entity\ElementGroup $group
     *
     * @return ElementType
     */
    public function setGroup(\MainBundle\Entity\ElementGroup $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \MainBundle\Entity\ElementGroup
     */
    public function getGroup()
    {
        return $this->group;
    }
}
