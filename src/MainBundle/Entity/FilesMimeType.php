<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSSerialize;
use JMS\Serializer\Annotation as SerializerAnnotation;

/**
 * FilesMimeType
 *
 * @ORM\Table(name="files_mime_type")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\FilesMimeTypeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class FilesMimeType
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
     * @ORM\Column(name="type", type="string", nullable=true)
     * @JMSSerialize\Groups({"files_data"})
     */
    private $type = 'jpg';

    /**
     * @var string
     *
     * @ORM\Column(name="mime_type", type="text", length=65535, nullable=true)
     * @JMSSerialize\Groups({"files_data"})
     */
    private $mimeType;

    /**
     * @var string
     *
     * @ORM\Column(name="viewer", type="string", nullable=true)
     */
    private $viewer = 'google_viewer';

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

    public function __toString() {
        return sprintf('%s - %s', $this->idIncrement, $this->type);
    }

    /**
     * @ORM\PrePersist
     */
    public function beforePersist()
    {
        $this->created = new \DateTime();
    }

    /**
     * @ORM\PreUpdate
     */
    public function beforeUpdate()
    {
        $this->updated = new \DateTime();
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
     * @return FilesMimeType
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
     * Set mimeType
     *
     * @param string $mimeType
     *
     * @return FilesMimeType
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set viewer
     *
     * @param string $viewer
     *
     * @return FilesMimeType
     */
    public function setViewer($viewer)
    {
        $this->viewer = $viewer;

        return $this;
    }

    /**
     * Get viewer
     *
     * @return string
     */
    public function getViewer()
    {
        return $this->viewer;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return FilesMimeType
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
     * @return FilesMimeType
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
     * @return FilesMimeType
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
}
