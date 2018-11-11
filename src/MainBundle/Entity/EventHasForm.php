<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as JMSSerialize;
use JMS\Serializer\Annotation as SerializerAnnotation;

/**
 * EventHasForm
 *
 * @ORM\Table(name="event_has_form", indexes={@ORM\Index(name="fk_event_has_form_event1_idx", columns={"event_id"}), @ORM\Index(name="fk_event_has_form_form1_idx", columns={"form_id"})})
 * @ORM\Entity(repositoryClass="MainBundle\Repository\EventHasFormRepository")
 * @ORM\HasLifecycleCallbacks
 */
class EventHasForm
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
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position = '9999';

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
     * @var \MainBundle\Entity\Event
     *
     * @ORM\ManyToOne(targetEntity="MainBundle\Entity\Event", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_id", referencedColumnName="id_increment", unique=true)
     * })
     * @JMSSerialize\Groups({"event_data"})
     */
    private $event;

    /**
     * @var \MainBundle\Entity\Form
     *
     * @ORM\OneToOne(targetEntity="MainBundle\Entity\Form")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="form_id", referencedColumnName="id_increment", unique=true)
     * })
     */
    private $form;

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
     * @return EventHasForm
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
     * Set position
     *
     * @param integer $position
     *
     * @return EventHasForm
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return EventHasForm
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
     * @return EventHasForm
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
     * Set event
     *
     * @param \MainBundle\Entity\Event $event
     *
     * @return EventHasForm
     */
    public function setEvent(\MainBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return \MainBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set form
     *
     * @param \MainBundle\Entity\Form $form
     *
     * @return EventHasForm
     */
    public function setForm(\MainBundle\Entity\Form $form = null)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * Get form
     *
     * @return \MainBundle\Entity\Form
     */
    public function getForm()
    {
        return $this->form;
    }
}
