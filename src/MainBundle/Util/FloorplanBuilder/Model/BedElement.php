<?php

namespace MainBundle\Util\FloorplanBuilder\Model;
use MainBundle\Entity\FloorPlan;
use MainBundle\Entity\Element;
use MainBundle\Util\FloorplanBuilder\ExtendsClass\gridLayout;
use MainBundle\Util\FloorplanBuilder\Interfaces\IElement;

class BedElement extends gridLayout implements IElement
{

    private $id;
    private $label;
    private $tag;

    /**
     * @param FloorPlan $floorPlan
     * @param Element $element
     */
    public function __construct(FloorPlan $floorPlan, Element $element)
    {
        parent::__construct();
        $this->id = $element->getIdIncrement();
        $this->label = $this->processLabel($element);
        $this->tag = $this->processTag($floorPlan, $element);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }


    /**
     * metodos que procesan info
     */
    function processLabel(Element $element)
    {
        return "";
    }

    function processTag(FloorPlan $floorPlan, Element $element)
    {

//        $color = ['bg-purple', 'bg-orange', 'bg-maroon', 'bg-olive', 'bg-aqua', 'bg-teal'];
        //$color[array_rand($color)]
//        position: static; top:  '.$positionY.'px; left:  '.$positionX.'px;
        // position: absolute; top:  0px; left:  0px; z-index:1;
        //        $out .= '<span  class="position">'.$positionX.' - '.$positionY.'</span>';






        $positionX = $element->getPositionX();
        $positionY = $element->getPositionY();

        $out = "";
        $out .= '<div class="drag-floorplan symbols" data-id="'.$element->getIdIncrement().'" style="top: '.$positionY.'px; left: '.$positionX.'px;">';
        $out .= '<img src="'.$element->getSymbolRoute().$element->getElementType()->getIcon().'" class="img-responsive"  >';
        $out .= "<input type='hidden' name='form[element][]' value='{$element->getIdIncrement()}'>";
        $out .= "</div>";

        return $out;
    }



}