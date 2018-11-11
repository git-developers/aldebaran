<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSSerialize;
use JMS\Serializer\Annotation as SerializerAnnotation;

/**
 * Video
 *
 * @ORM\Table(name="video", indexes={@ORM\Index(name="fk_video_user1_idx", columns={"user_id"})})
 * @ORM\Entity(repositoryClass="MainBundle\Repository\VideoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Video
{
    const MAX_RESULTS_4 = 4;
    const ACCESS_PRIVATE = 'private';
    const ACCESS_PUBLIC = 'public';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSSerialize\Groups({"video_data"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", length=65535, nullable=false)
     * @JMSSerialize\Groups({"video_data"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text", length=65535, nullable=true)
     * @JMSSerialize\Groups({"video_data"})
     */
    private $body;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_url", type="text", length=65535, nullable=false)
     */
    private $youtubeUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_id", type="string", length=45, nullable=true)
     */
    private $youtubeId;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_thumbnail", type="string", length=100, nullable=true)
     * @JMSSerialize\Groups({"video_data"})
     */
    private $youtubeThumbnail;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_duration", type="string", length=45, nullable=true)
     * @JMSSerialize\Groups({"video_data"})
     */
    private $youtubeDuration;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_title", type="text", length=65535, nullable=true)
     */
    private $youtubeTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_description", type="text", length=65535, nullable=true)
     */
    private $youtubeDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_viewCount", type="string", length=45, nullable=true)
     */
    private $youtubeViewcount;

    /**
     * @var string
     *
     * @ORM\Column(name="access", type="string", nullable=false)
     * @JMSSerialize\Groups({"video_data"})
     */
    private $access = 'private';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     * @SerializerAnnotation\Type("DateTime<'H:i Y-m-d'>")
     * @JMSSerialize\Groups({"video_data"})
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
     * @JMSSerialize\Groups({"video_data"})
     */
    private $user;

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
     * @return Video
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
     * @return Video
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
     * @return Video
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
     * Set youtubeUrl
     *
     * @param string $youtubeUrl
     *
     * @return Video
     */
    public function setYoutubeUrl($youtubeUrl)
    {
        $this->youtubeUrl = $youtubeUrl;

        return $this;
    }

    /**
     * Get youtubeUrl
     *
     * @return string
     */
    public function getYoutubeUrl()
    {
        return $this->youtubeUrl;
    }

    /**
     * Set youtubeId
     *
     * @param string $youtubeId
     *
     * @return Video
     */
    public function setYoutubeId($youtubeId)
    {
        $this->youtubeId = $youtubeId;

        return $this;
    }

    /**
     * Get youtubeId
     *
     * @return string
     */
    public function getYoutubeId()
    {
        return $this->youtubeId;
    }

    /**
     * Set youtubeThumbnail
     *
     * @param string $youtubeThumbnail
     *
     * @return Video
     */
    public function setYoutubeThumbnail($youtubeThumbnail)
    {
        $this->youtubeThumbnail = $youtubeThumbnail;

        return $this;
    }

    /**
     * Get youtubeThumbnail
     *
     * @return string
     */
    public function getYoutubeThumbnail()
    {
        return $this->youtubeThumbnail;
    }

    /**
     * Set youtubeDuration
     *
     * @param string $youtubeDuration
     *
     * @return Video
     */
    public function setYoutubeDuration($youtubeDuration)
    {
        $this->youtubeDuration = $youtubeDuration;

        return $this;
    }

    /**
     * Get youtubeDuration
     *
     * @return string
     */
    public function getYoutubeDuration()
    {
        return $this->youtubeDuration;
    }

    /**
     * Set youtubeTitle
     *
     * @param string $youtubeTitle
     *
     * @return Video
     */
    public function setYoutubeTitle($youtubeTitle)
    {
        $this->youtubeTitle = $youtubeTitle;

        return $this;
    }

    /**
     * Get youtubeTitle
     *
     * @return string
     */
    public function getYoutubeTitle()
    {
        return $this->youtubeTitle;
    }

    /**
     * Set youtubeDescription
     *
     * @param string $youtubeDescription
     *
     * @return Video
     */
    public function setYoutubeDescription($youtubeDescription)
    {
        $this->youtubeDescription = $youtubeDescription;

        return $this;
    }

    /**
     * Get youtubeDescription
     *
     * @return string
     */
    public function getYoutubeDescription()
    {
        return $this->youtubeDescription;
    }

    /**
     * Set youtubeViewcount
     *
     * @param string $youtubeViewcount
     *
     * @return Video
     */
    public function setYoutubeViewcount($youtubeViewcount)
    {
        $this->youtubeViewcount = $youtubeViewcount;

        return $this;
    }

    /**
     * Get youtubeViewcount
     *
     * @return string
     */
    public function getYoutubeViewcount()
    {
        return $this->youtubeViewcount;
    }

    /**
     * Set access
     *
     * @param string $access
     *
     * @return Video
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * Get access
     *
     * @return string
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Video
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
     * @return Video
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
     * @return Video
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
     * @return Video
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
}
