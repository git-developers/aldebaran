<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSSerialize;
use JMS\Serializer\Annotation as SerializerAnnotation;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Files
 *
 * @ORM\Table(name="files", indexes={@ORM\Index(name="fk_document_user1_idx", columns={"user_id"}), @ORM\Index(name="fk_files_files_mime_type1_idx", columns={"files_mime_type_id"})})
 * @ORM\Entity(repositoryClass="MainBundle\Repository\FilesRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Files
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSSerialize\Groups({"files_data"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=65535, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="original_name", type="text", length=65535, nullable=true)
     * @JMSSerialize\Groups({"files_data"})
     */
    private $originalName;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="text", length=65535, nullable=true)
     * @JMSSerialize\Groups({"files_data", "news_data", "carousel_data", "banner_data", "product_data"})
     */
    private $path;

    /**
     * @var integer
     *
     * @ORM\Column(name="size", type="integer", nullable=true)
     * @JMSSerialize\Groups({"files_data"})
     */
    private $size;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     * @SerializerAnnotation\Type("DateTime<'H:i Y-m-d'>")
     * @JMSSerialize\Groups({"files_data"})
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var \MainBundle\Entity\User
     *
     * @ORM\OneToOne(targetEntity="MainBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id_increment", unique=true)
     * })
     * @JMSSerialize\Groups({"files_data"})
     */
    private $user;

    /**
     * @var \MainBundle\Entity\FilesMimeType
     *
     * @ORM\OneToOne(targetEntity="MainBundle\Entity\FilesMimeType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="files_mime_type_id", referencedColumnName="id_increment", unique=true)
     * })
     * @JMSSerialize\Groups({"files_data"})
     */
    private $filesMimeType;

    /**
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png", "image/tiff"},
     *     maxSizeMessage = "The maxmimum allowed file size is 5MB.",
     *     mimeTypesMessage = "Only the filetypes image are allowed."
     * )
     */
    private $file;

    /**
     * Constructor
     */
    public function __construct()
    {

    }


    public function __toString() {
        return sprintf('%s - %s', $this->idIncrement, $this->originalName);
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
     * Set idIncrement
     *
     * @param integer $idIncrement
     *
     * @return Files
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
     * Set name
     *
     * @param string $name
     *
     * @return Files
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
     * Set originalName
     *
     * @param string $originalName
     *
     * @return Files
     */
    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }

    /**
     * Get originalName
     *
     * @return string
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Files
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set size
     *
     * @param integer $size
     *
     * @return Files
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Files
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Files
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
     * @return Files
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
     * Set user
     *
     * @param \MainBundle\Entity\User $user
     *
     * @return Files
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
     * Set filesMimeType
     *
     * @param \MainBundle\Entity\FilesMimeType $filesMimeType
     *
     * @return Files
     */
    public function setFilesMimeType(\MainBundle\Entity\FilesMimeType $filesMimeType = null)
    {
        $this->filesMimeType = $filesMimeType;

        return $this;
    }

    /**
     * Get filesMimeType
     *
     * @return \MainBundle\Entity\FilesMimeType
     */
    public function getFilesMimeType()
    {
        return $this->filesMimeType;
    }


    /**
     * *****************************
     * UPLOAD IMAGE METHODS
     */
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }


    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../web/'.$this->getUploadDir();

    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads';
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->path = $this->getFile()->getClientOriginalName();
        //$this->path = $this->getUploadRootDir().'/'.$this->getFile()->getClientOriginalName();
        $this->name = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }
    /**
     * *****************************
     * UPLOAD IMAGE METHODS
     */




}
