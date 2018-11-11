<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSSerialize;
use JMS\Serializer\Annotation as SerializerAnnotation;

/**
 * News
 *
 * @ORM\Table(name="news", indexes={@ORM\Index(name="fk_section_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_news_files1_idx", columns={"files_id"})})
 * @ORM\Entity(repositoryClass="MainBundle\Repository\NewsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class News
{

    const MAX_RESULTS_2 = 2;
    const PUBLISHED = 'published';
    const UNPUBLISHED = 'unpublished';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSSerialize\Groups({"news_data"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", length=65535, nullable=false)
     * @JMSSerialize\Groups({"news_data"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", length=65535, nullable=false)
     * @JMSSerialize\Groups({"news_data"})
     */
    private $body;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="news_date", type="datetime", nullable=true)
     * @SerializerAnnotation\Type("DateTime<'Y-m-d'>")
     * @JMSSerialize\Groups({"news_data"})
     */
    private $newsDate;

    /**
     * @var string
     *
     * @ORM\Column(name="news_status", type="string", nullable=true)
     * @JMSSerialize\Groups({"news_data"})
     */
    private $newsStatus = 'unpublished';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     * @SerializerAnnotation\Type("DateTime<'H:i Y-m-d'>")
     * @JMSSerialize\Groups({"news_data"})
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
     * @var \MainBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="MainBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id_increment", unique=true)
     * })
     * @JMSSerialize\Groups({"news_data"})
     */
    private $user;

    /**
     * @var \MainBundle\Entity\Files
     *
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Files")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="files_id", referencedColumnName="id_increment")
     * })
     * @JMSSerialize\Groups({"news_data"})
     */
    private $files;

    /**
     * @var string
     *
     * @JMSSerialize\Groups({"news_data"})
     */
    private $fileName;

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
     * Set idIncrement
     *
     * @param integer $idIncrement
     *
     * @return News
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
     * Set title
     *
     * @param string $title
     *
     * @return News
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return News
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set newsDate
     *
     * @param \DateTime $newsDate
     *
     * @return News
     */
    public function setNewsDate($newsDate)
    {
        $this->newsDate = $newsDate;

        return $this;
    }

    /**
     * Get newsDate
     *
     * @return \DateTime
     */
    public function getNewsDate()
    {
        return $this->newsDate;
    }

    /**
     * Set newsStatus
     *
     * @param string $newsStatus
     *
     * @return News
     */
    public function setNewsStatus($newsStatus)
    {
        $this->newsStatus = $newsStatus;

        return $this;
    }

    /**
     * Get newsStatus
     *
     * @return string
     */
    public function getNewsStatus()
    {
        return $this->newsStatus;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return News
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
     * @return News
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
     * @return News
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
     * Set user
     *
     * @param \MainBundle\Entity\User $user
     *
     * @return News
     */
    public function setUser(\MainBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MainBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set files
     *
     * @param \MainBundle\Entity\Files $files
     *
     * @return News
     */
    public function setFiles(\MainBundle\Entity\Files $files = null)
    {
        $this->files = $files;

        return $this;
    }

    /**
     * Get files
     *
     * @return \MainBundle\Entity\Files
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        if(is_object($this->files)){
            return $this->files->getOriginalName();
        }

        return null;
    }

    /**
     * @param string $fileName
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

}
