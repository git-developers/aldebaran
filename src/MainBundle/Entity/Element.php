<?php

namespace MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMSSerialize;
use JMS\Serializer\Annotation as SerializerAnnotation;

/**
 * Element
 *
 * @ORM\Table(name="element", uniqueConstraints={@ORM\UniqueConstraint(name="unique_id_UNIQUE", columns={"unique_id"})}, indexes={@ORM\Index(name="fk_element_element_type1_idx", columns={"element_type_id"})})
 * @ORM\Entity(repositoryClass="MainBundle\Repository\ElementRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Element
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_increment", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @JMSSerialize\Groups({"form_data"})
     */
    private $idIncrement;

    /**
     * @var string
     *
     * @ORM\Column(name="unique_id", type="string", length=45, nullable=false)
     */
    private $uniqueId;

    /**
     * @var integer
     *
     * @ORM\Column(name="stack_order", type="integer", nullable=false)
     */
    private $stackOrder = '9999';

    /**
     * @var string
     *
     * @ORM\Column(name="position_x", type="decimal", precision=18, scale=12, nullable=true)
     */
    private $positionX;

    /**
     * @var string
     *
     * @ORM\Column(name="position_y", type="decimal", precision=18, scale=12, nullable=true)
     */
    private $positionY;

    /**
     * @var string
     *
     * @ORM\Column(name="tag_id", type="string", length=45, nullable=true)
     */
    private $tagId;

    /**
     * @var string
     *
     * @ORM\Column(name="tag_name", type="string", length=100, nullable=true)
     * @JMSSerialize\Groups({"form_data"})
     */
    private $tagName;

    /**
     * @var string
     *
     * @ORM\Column(name="tag_value", type="string", length=100, nullable=true)
     */
    private $tagValue;

    /**
     * @var string
     *
     * @ORM\Column(name="tag_title", type="string", length=100, nullable=true)
     */
    private $tagTitle;

    /**
     * @var integer
     *
     * @ORM\Column(name="tag_size", type="integer", nullable=true)
     */
    private $tagSize;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tag_readonly", type="boolean", nullable=true)
     */
    private $tagReadonly;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tag_disabled", type="boolean", nullable=true)
     */
    private $tagDisabled;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tag_required", type="boolean", nullable=true)
     */
    private $tagRequired;

    /**
     * @var integer
     *
     * @ORM\Column(name="tag_max", type="integer", nullable=true)
     */
    private $tagMax;

    /**
     * @var integer
     *
     * @ORM\Column(name="tag_min", type="integer", nullable=true)
     */
    private $tagMin;

    /**
     * @var integer
     *
     * @ORM\Column(name="tag_maxlength", type="integer", nullable=true)
     */
    private $tagMaxlength;

    /**
     * @var string
     *
     * @ORM\Column(name="tag_pattern", type="string", length=45, nullable=true)
     */
    private $tagPattern;

    /**
     * @var string
     *
     * @ORM\Column(name="tag_step", type="string", length=45, nullable=true)
     */
    private $tagStep;

    /**
     * @var string
     *
     * @ORM\Column(name="tag_onclick", type="string", length=100, nullable=true)
     */
    private $tagOnclick;

    /**
     * @var string
     *
     * @ORM\Column(name="tag_placeholder", type="string", length=45, nullable=true)
     */
    private $tagPlaceholder;

    /**
     * @var integer
     *
     * @ORM\Column(name="tag_rows", type="integer", nullable=true)
     */
    private $tagRows;

    /**
     * @var integer
     *
     * @ORM\Column(name="tag_cols", type="integer", nullable=true)
     */
    private $tagCols;

    /**
     * @var string
     *
     * @ORM\Column(name="tag_autofocus", type="string", length=45, nullable=true)
     */
    private $tagAutofocus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tag_multiple", type="boolean", nullable=true)
     */
    private $tagMultiple;

    /**
     * @var string
     *
     * @ORM\Column(name="label_name", type="string", length=100, nullable=true)
     */
    private $labelName;

    /**
     * @var string
     *
     * @ORM\Column(name="label_for", type="string", length=45, nullable=true)
     */
    private $labelFor;

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
     * @var \MainBundle\Entity\ElementType
     *
     * @ORM\OneToOne(targetEntity="MainBundle\Entity\ElementType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="element_type_id", referencedColumnName="id_increment", unique=true)
     * })
     */
    private $elementType;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MainBundle\Entity\Form", mappedBy="element")
     */
    private $form;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="MainBundle\Entity\FloorPlan", mappedBy="element")
     */
    private $floorPlan;

    /**
     * @var string
     *
     */
    private $symbolRoute;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->floorPlan = new \Doctrine\Common\Collections\ArrayCollection();
        $this->form = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        return sprintf('%s - %s', $this->idIncrement, $this->tagName);
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
     * @return Element
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
     * Set uniqueId
     *
     * @param string $uniqueId
     *
     * @return Element
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }

    /**
     * Get uniqueId
     *
     * @return string
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * Set stackOrder
     *
     * @param integer $stackOrder
     *
     * @return Element
     */
    public function setStackOrder($stackOrder)
    {
        $this->stackOrder = $stackOrder;

        return $this;
    }

    /**
     * Get stackOrder
     *
     * @return integer
     */
    public function getStackOrder()
    {
        return $this->stackOrder;
    }


    /**
     * Set positionX
     *
     * @param string $positionX
     *
     * @return Element
     */
    public function setPositionX($positionX)
    {
        $this->positionX = $positionX;

        return $this;
    }

    /**
     * Get positionX
     *
     * @return string
     */
    public function getPositionX()
    {
        return $this->positionX;
    }

    /**
     * Set positionY
     *
     * @param string $positionY
     *
     * @return Element
     */
    public function setPositionY($positionY)
    {
        $this->positionY = $positionY;

        return $this;
    }

    /**
     * Get positionY
     *
     * @return string
     */
    public function getPositionY()
    {
        return $this->positionY;
    }

    /**
     * Set tagId
     *
     * @param string $tagId
     *
     * @return Element
     */
    public function setTagId($tagId)
    {
        $this->tagId = $tagId;

        return $this;
    }

    /**
     * Get tagId
     *
     * @return string
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * Set tagName
     *
     * @param string $tagName
     *
     * @return Element
     */
    public function setTagName($tagName)
    {
        $this->tagName = $tagName;

        return $this;
    }

    /**
     * Get tagName
     *
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }

    /**
     * Set tagValue
     *
     * @param string $tagValue
     *
     * @return Element
     */
    public function setTagValue($tagValue)
    {
        $this->tagValue = $tagValue;

        return $this;
    }

    /**
     * Get tagValue
     *
     * @return string
     */
    public function getTagValue()
    {
        return $this->tagValue;
    }

    /**
     * Set tagTitle
     *
     * @param string $tagTitle
     *
     * @return Element
     */
    public function setTagTitle($tagTitle)
    {
        $this->tagTitle = $tagTitle;

        return $this;
    }

    /**
     * Get tagTitle
     *
     * @return string
     */
    public function getTagTitle()
    {
        return $this->tagTitle;
    }

    /**
     * Set tagSize
     *
     * @param integer $tagSize
     *
     * @return Element
     */
    public function setTagSize($tagSize)
    {
        $this->tagSize = $tagSize;

        return $this;
    }

    /**
     * Get tagSize
     *
     * @return integer
     */
    public function getTagSize()
    {
        return $this->tagSize;
    }

    /**
     * Set tagReadonly
     *
     * @param boolean $tagReadonly
     *
     * @return Element
     */
    public function setTagReadonly($tagReadonly)
    {
        $this->tagReadonly = $tagReadonly;

        return $this;
    }

    /**
     * Get tagReadonly
     *
     * @return boolean
     */
    public function getTagReadonly()
    {
        return $this->tagReadonly;
    }

    /**
     * Set tagDisabled
     *
     * @param boolean $tagDisabled
     *
     * @return Element
     */
    public function setTagDisabled($tagDisabled)
    {
        $this->tagDisabled = $tagDisabled;

        return $this;
    }

    /**
     * Get tagDisabled
     *
     * @return boolean
     */
    public function getTagDisabled()
    {
        return $this->tagDisabled;
    }

    /**
     * Set tagRequired
     *
     * @param boolean $tagRequired
     *
     * @return Element
     */
    public function setTagRequired($tagRequired)
    {
        $this->tagRequired = $tagRequired;

        return $this;
    }

    /**
     * Get tagRequired
     *
     * @return boolean
     */
    public function getTagRequired()
    {
        return $this->tagRequired;
    }

    /**
     * Set tagMax
     *
     * @param integer $tagMax
     *
     * @return Element
     */
    public function setTagMax($tagMax)
    {
        $this->tagMax = $tagMax;

        return $this;
    }

    /**
     * Get tagMax
     *
     * @return integer
     */
    public function getTagMax()
    {
        return $this->tagMax;
    }

    /**
     * Set tagMin
     *
     * @param integer $tagMin
     *
     * @return Element
     */
    public function setTagMin($tagMin)
    {
        $this->tagMin = $tagMin;

        return $this;
    }

    /**
     * Get tagMin
     *
     * @return integer
     */
    public function getTagMin()
    {
        return $this->tagMin;
    }

    /**
     * Set tagMaxlength
     *
     * @param integer $tagMaxlength
     *
     * @return Element
     */
    public function setTagMaxlength($tagMaxlength)
    {
        $this->tagMaxlength = $tagMaxlength;

        return $this;
    }

    /**
     * Get tagMaxlength
     *
     * @return integer
     */
    public function getTagMaxlength()
    {
        return $this->tagMaxlength;
    }

    /**
     * Set tagPattern
     *
     * @param string $tagPattern
     *
     * @return Element
     */
    public function setTagPattern($tagPattern)
    {
        $this->tagPattern = $tagPattern;

        return $this;
    }

    /**
     * Get tagPattern
     *
     * @return string
     */
    public function getTagPattern()
    {
        return $this->tagPattern;
    }

    /**
     * Set tagStep
     *
     * @param string $tagStep
     *
     * @return Element
     */
    public function setTagStep($tagStep)
    {
        $this->tagStep = $tagStep;

        return $this;
    }

    /**
     * Get tagStep
     *
     * @return string
     */
    public function getTagStep()
    {
        return $this->tagStep;
    }

    /**
     * Set tagOnclick
     *
     * @param string $tagOnclick
     *
     * @return Element
     */
    public function setTagOnclick($tagOnclick)
    {
        $this->tagOnclick = $tagOnclick;

        return $this;
    }

    /**
     * Get tagOnclick
     *
     * @return string
     */
    public function getTagOnclick()
    {
        return $this->tagOnclick;
    }

    /**
     * Set tagPlaceholder
     *
     * @param string $tagPlaceholder
     *
     * @return Element
     */
    public function setTagPlaceholder($tagPlaceholder)
    {
        $this->tagPlaceholder = $tagPlaceholder;

        return $this;
    }

    /**
     * Get tagPlaceholder
     *
     * @return string
     */
    public function getTagPlaceholder()
    {
        return $this->tagPlaceholder;
    }

    /**
     * Set tagRows
     *
     * @param integer $tagRows
     *
     * @return Element
     */
    public function setTagRows($tagRows)
    {
        $this->tagRows = $tagRows;

        return $this;
    }

    /**
     * Get tagRows
     *
     * @return integer
     */
    public function getTagRows()
    {
        return $this->tagRows;
    }

    /**
     * Set tagCols
     *
     * @param integer $tagCols
     *
     * @return Element
     */
    public function setTagCols($tagCols)
    {
        $this->tagCols = $tagCols;

        return $this;
    }

    /**
     * Get tagCols
     *
     * @return integer
     */
    public function getTagCols()
    {
        return $this->tagCols;
    }

    /**
     * Set tagAutofocus
     *
     * @param string $tagAutofocus
     *
     * @return Element
     */
    public function setTagAutofocus($tagAutofocus)
    {
        $this->tagAutofocus = $tagAutofocus;

        return $this;
    }

    /**
     * Get tagAutofocus
     *
     * @return string
     */
    public function getTagAutofocus()
    {
        return $this->tagAutofocus;
    }

    /**
     * Set tagMultiple
     *
     * @param boolean $tagMultiple
     *
     * @return Element
     */
    public function setTagMultiple($tagMultiple)
    {
        $this->tagMultiple = $tagMultiple;

        return $this;
    }

    /**
     * Get tagMultiple
     *
     * @return boolean
     */
    public function getTagMultiple()
    {
        return $this->tagMultiple;
    }

    /**
     * Set labelName
     *
     * @param string $labelName
     *
     * @return Element
     */
    public function setLabelName($labelName)
    {
        $this->labelName = $labelName;

        return $this;
    }

    /**
     * Get labelName
     *
     * @return string
     */
    public function getLabelName()
    {
        return $this->labelName;
    }

    /**
     * Set labelFor
     *
     * @param string $labelFor
     *
     * @return Element
     */
    public function setLabelFor($labelFor)
    {
        $this->labelFor = $labelFor;

        return $this;
    }

    /**
     * Get labelFor
     *
     * @return string
     */
    public function getLabelFor()
    {
        return $this->labelFor;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Element
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
     * @return Element
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
     * @return Element
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
     * Set elementType
     *
     * @param \MainBundle\Entity\ElementType $elementType
     *
     * @return Element
     */
    public function setElementType(\MainBundle\Entity\ElementType $elementType = null)
    {
        $this->elementType = $elementType;

        return $this;
    }

    /**
     * Get elementType
     *
     * @return \MainBundle\Entity\ElementType
     */
    public function getElementType()
    {
        return $this->elementType;
    }

    /**
     * Add form
     *
     * @param \MainBundle\Entity\Form $form
     *
     * @return Element
     */
    public function addForm(\MainBundle\Entity\Form $form)
    {
        $this->form[] = $form;

        return $this;
    }

    /**
     * Remove form
     *
     * @param \MainBundle\Entity\Form $form
     */
    public function removeForm(\MainBundle\Entity\Form $form)
    {
        $this->form->removeElement($form);
    }

    /**
     * Get form
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getForm()
    {
        return $this->form;
    }


    /**
     * Add floorPlan
     *
     * @param \MainBundle\Entity\FloorPlan $floorPlan
     *
     * @return Element
     */
    public function addFloorPlan(\MainBundle\Entity\FloorPlan $floorPlan)
    {
        $this->floorPlan[] = $floorPlan;

        return $this;
    }

    /**
     * Remove floorPlan
     *
     * @param \MainBundle\Entity\FloorPlan $floorPlan
     */
    public function removeFloorPlan(\MainBundle\Entity\FloorPlan $floorPlan)
    {
        $this->floorPlan->removeElement($floorPlan);
    }

    /**
     * Get floorPlan
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFloorPlan()
    {
        return $this->floorPlan;
    }

    /**
     * @return string
     */
    public function getSymbolRoute()
    {
        return $this->symbolRoute;
    }

    /**
     * @param string $symbolRoute
     */
    public function setSymbolRoute($symbolRoute)
    {
        $this->symbolRoute = $symbolRoute;
    }

    public function l($elementType)
    {
        switch($elementType){
            case 'CheckboxElement':
                return 'Etiqueta multiple elección';
                break;
            case 'ColorElement':
                return 'Etiqueta color';
                break;
            case 'DateElement':
                return 'Etiqueta fecha';
                break;
            case 'EmailElement':
                return 'Etiqueta email';
                break;
            case 'MapElement':
                return 'Etiqueta mapa';
                break;
            case 'NumberElement':
                return 'Etiqueta numero';
                break;
            case 'PagebreakElement':
                return 'Etiqueta pagebreak';
                break;
            case 'RadioElement':
                return 'Etiqueta una elección';
                break;
            case 'RangeElement':
                return 'Etiqueta rango';
                break;
            case 'TextareaElement':
                return 'Etiqueta parrafo';
                break;
            case 'TextElement':
                return 'Etiqueta texto';
                break;
            case 'TimeElement':
                return 'Etiqueta hora';
                break;
            case 'UrlElement':
                return 'Etiqueta url';
                break;
            default:
                return 'Etiqueta';
                break;
        }
    }

    public function ph($elementType)
    {
        switch($elementType){
            case 'ColorElement':
                return '';
                break;
            case 'DateElement':
                return '';
                break;
            case 'EmailElement':
                return 'test@aldebaran.com';
                break;
            case 'MapElement':
                return '';
                break;
            case 'NumberElement':
                return 'ingrese un numero';
                break;
            case 'RangeElement':
                return '';
                break;
            case 'TextareaElement':
                return 'ingrese parrafo';
                break;
            case 'TextElement':
                return 'ingrese un texto';
                break;
            case 'TimeElement':
                return '';
                break;
            case 'UrlElement':
                return 'http://';
                break;
            default:
                return 'ingrese default';
                break;
        }
    }


}
