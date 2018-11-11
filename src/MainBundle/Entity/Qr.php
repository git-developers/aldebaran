<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSSerialize;
use JMS\Serializer\Annotation as SerializerAnnotation;

/**
 * Qr
 *
 * @ORM\Table(name="qr")
 * @ORM\Entity(repositoryClass="MainBundle\Repository\QrRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Qr
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSSerialize\Groups({"qr_data"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="cht", type="string", length=45, nullable=false)
     */
    private $cht = 'qr';

    /**
     * @var string
     *
     * @ORM\Column(name="chl", type="text", length=65535, nullable=false)
     * @JMSSerialize\Groups({"qr_data"})
     */
    private $chl;

    /**
     * @var string
     *
     * @ORM\Column(name="chs", type="string", length=45, nullable=false)
     * @JMSSerialize\Groups({"qr_data"})
     */
    private $chs;

    /**
     * @var string
     *
     * @ORM\Column(name="choe", type="string", length=45, nullable=true)
     * @JMSSerialize\Groups({"qr_data"})
     */
    private $choe;

    /**
     * @var string
     *
     * @ORM\Column(name="chld", type="string", length=45, nullable=true)
     * @JMSSerialize\Groups({"qr_data"})
     */
    private $chld;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     * @SerializerAnnotation\Type("DateTime<'H:i Y-m-d'>")
     * @JMSSerialize\Groups({"qr_data"})
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
    private $status = 1;

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
     * Set cht
     *
     * @param string $cht
     *
     * @return Qr
     */
    public function setCht($cht)
    {
        $this->cht = $cht;

        return $this;
    }

    /**
     * Get cht
     *
     * @return string
     */
    public function getCht()
    {
        return $this->cht;
    }

    /**
     * Set chl
     *
     * @param string $chl
     *
     * @return Qr
     */
    public function setChl($chl)
    {
        $this->chl = $chl;

        return $this;
    }

    /**
     * Get chl
     *
     * @return string
     */
    public function getChl()
    {
        return $this->chl;
    }

    /**
     * Set chs
     *
     * @param string $chs
     *
     * @return Qr
     */
    public function setChs($chs)
    {
        $this->chs = $chs;

        return $this;
    }

    /**
     * Get chs
     *
     * @return string
     */
    public function getChs()
    {
        return $this->chs;
    }

    /**
     * Set choe
     *
     * @param string $choe
     *
     * @return Qr
     */
    public function setChoe($choe)
    {
        $this->choe = $choe;

        return $this;
    }

    /**
     * Get choe
     *
     * @return string
     */
    public function getChoe()
    {
        return $this->choe;
    }

    /**
     * Set chld
     *
     * @param string $chld
     *
     * @return Qr
     */
    public function setChld($chld)
    {
        $this->chld = $chld;

        return $this;
    }

    /**
     * Get chld
     *
     * @return string
     */
    public function getChld()
    {
        return $this->chld;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Qr
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
     * @return Qr
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
     * @return Qr
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
